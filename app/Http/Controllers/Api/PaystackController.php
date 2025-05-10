<?php

/**
 * Trip Controller
 *
 * @package     NewTaxi Prime
 * @subpackage  Controller
 * @category    Trip
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Http\Controllers\Api;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Payment;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Trips;
use App\Models\PoolTrip;
use App\Models\DriverOweAmount;
use App\Models\ReferralUser;
use App\Models\AppliedReferrals;
use App\Models\DriverOweAmountPayment;
use App\Http\Helper\InvoiceHelper;
use App\Http\Helper\RequestHelper;
use App\Models\Transaction;
use JWTAuth;
use Session;
class PaystackController extends Controller
{
    public function __construct(InvoiceHelper $invoice_helper)
	{
		$this->invoice_helper = $invoice_helper;
	}
	public function setSessonData($data,$user)
	{
        session()->forget('payment_data');
		$value['amount']                   = $data['amount'];
        $value['currency_code']            = $data['currency_code'];
        $value['payment_type']             = request()->payment_type;
        $value['user_token']               = request()->token;
        $value['pay_for']                  = request()->pay_for;
        $value['original_amount']          = request()->amount;
        $value['applied_referral_amount']  = request()->applied_referral_amount;
        $value['trip_id']                  = request()->trip_id;
        session()->put('payment_data',$value);
	}

	public function get_user_deatils()
	{
		if(session()->has('payment_data.user_token') || request()->token){
			if(request()->token){
				return \JWTAuth::parseToken()->authenticate();
			}
        	$set_token = \JWTAuth::setToken(session()->get('payment_data.user_token'));
			return  $set_token->toUser();
		}
		else
			return auth()->guard('web')->user();
	}
	public function set_user_deatils()
	{
		if(request()->token)
			return \JWTAuth::parseToken()->authenticate();
		else
			return auth()->guard('web')->user();
	}
	
	 public static function paystack(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payment_id = uniqid();
        
        // Convert Currency to your Merchant Supported Currency(Default is in NGN)
        $data['currency_code'] = 'NGN';
        $amount=$request->amount;
        if($user->currency_code !="NGN"){
           $amount = currencyConvert($user->currency_code,$data['currency_code'],request()->amount);  
        }

        $data['amount'] =  $amount;
        $data['public_key'] = payment_gateway('public_key','Paystack');
        $data['callback'] = payment_gateway('callback_url','Paystack');
		$data['currency_code'] = $user->currency_code;
		$data['payment_type'] = 'paystack';
		$data['pay_for'] = $request->pay_for;
		$data['token'] = $request->token;
		$data['user_id'] = $user->id;
		$data['payment_id'] = $payment_id;
		
		//Store transaction on database
		$Paystack = new Transaction();
        $Paystack->user_id =$user->id;
        $Paystack->payment_id = $payment_id;
        $Paystack->payment_type = "paystack";
        $Paystack->currency =  $user->currency_code;
        $Paystack->amount = $request->amount;
        $Paystack->pay_for = $request->pay_for;
        $Paystack-> save();
		
		return view('payment.paystack',$data);
    
    }
    
   public function paystack_callback(Request $request) {
     //$userId = $request->userid;
        $paymentId = $request->query('payment_id');
       
        $txRef = $paymentId;
       
        //cURL Request
        $transaction_id = $request->successfullypaid;
		if ($transaction_id !=null) {
			$paystack_payment = Transaction::where('payment_id',$txRef)->where('status','Pending')->latest()->first();
			if($paystack_payment){
			    $userId = $paystack_payment->user_id;
			}
			
			$user = User::where('id',$userId)->first();
		
		
			if($paystack_payment){
			    $paystack_transaction = Transaction::find($paystack_payment->id);
			    
    			if ($paystack_transaction) {
                    $paystack_transaction->status = 'Paid'; // Set the new value for the status
                    $paystack_transaction->transaction_id =  $transaction_id;
                    $paystack_transaction->payment_desc =  "Transaction was Successful";
                    $paystack_transaction->save(); // Save the changes to the database
                }
			    if($paystack_payment->pay_for=="wallet"){
			        
			        	$wallet = Wallet::whereUserId($user->id)->first();

                        $wallet_amount = $paystack_payment->amount;
                		if($wallet) {
                			$wallet_amount = floatval($wallet->original_amount) + floatval($wallet_amount);
                		}
                		else {
                			$wallet = new Wallet;
                		}
                
                		$wallet->amount = $wallet_amount;
                		$wallet->paykey = $transaction_id;
                		$wallet->currency_code = $user->currency_code;
                		$wallet->user_id = $user->id;
                		$wallet->save();
            
    			         $paymentData = ([
				 'status_code' => '0',
			     'status_message' => __('messages.api.not_generate_amount'),
			      ]);
                  return $this->returnView($paymentData); 
			        
			    }else if($paystack_payment->pay_for=="pay_to_admin"){
			        
			      $owe_amount = DriverOweAmount::where('user_id', $user->id)->first();
		          if ($owe_amount && $owe_amount->amount > 0) {
		
        			//pay to admin from payout preference start
        			$owe_amount = DriverOweAmount::where('user_id', $user->id)->first();
        
        			$amount = $paystack_payment->amount;
    
        			if($amount > 0) {
        				if($owe_amount->amount < $amount) {
        					$paymentData = ([
        				    'status_code' => '0',
        					'status_message' => trans('messages.api.invalid'),
        					
        			        ]);
        			        return $this->returnView($paymentData);
        				}
        
        
        				$owe_amount = DriverOweAmount::where('user_id', $user->id)->first();
        				$total_owe_amount = $owe_amount->amount;
        				$currency_code = $owe_amount->currency_code;
        				$remaining_amount = $total_owe_amount - $amount;
        
        				$currency_code = $user->currency_code;
        				
        
        
        				//owe amount
        				$owe_amount->amount = $remaining_amount;
        				$owe_amount->currency_code = $currency_code;
        				$owe_amount->save();
        
        				$payment = new DriverOweAmountPayment;
        				$payment->user_id = $user->id;
        				$payment->transaction_id = $transaction_id;
        				$payment->amount = $paystack_payment->amount;
        				$payment->status = 1;
        				$payment->currency_code = $currency_code;
        				$payment->save();
        
        				$owe_amount = DriverOweAmount::where('user_id', $user->id)->first();
        			}
        
        			$referral_amount = ReferralUser::where('user_id',$user->id)->where('payment_status','Completed')->where('pending_amount','>',0)->get();
        			$referral_amount = number_format($referral_amount->sum('pending_amount'),2,'.','');
        
        			
        			 $paymentData = ([
        				'status_code' 	=> '1',
        				'status_message'=> __('messages.payment_complete_success'),
        				'referral_amount' => $referral_amount,
        				'owe_amount' 	=> $owe_amount->amount,
        				'currency_code' => $owe_amount->currency_code,
        			     ]);
        			 return $this->returnView($paymentData);
        	      }else{
        	      $paymentData = ([
				 'status_code' => '0',
			     'status_message' => __('messages.api.not_generate_amount'),
			      ]);
                  return $this->returnView($paymentData);  
        	      }
			        
			    }else if($paystack_payment->pay_for=="trip"){
			        $trip_id = Trips::where('user_id',$user->id)->where('payment_status',"Pending")->where('payment_mode',"Paystack")->latest()->first();
			        
			        $trip = Trips::find($trip_id->id); 

            		if($trip->is_calculation == 0) {
            			$data = [
            				'trip_id' => $trip->id,
            				'user_id' => $user->id,
            				'save_to_trip_table' => 1,
            			];
            			$trip = $this->invoice_helper->calculation($data);
            		}
            
            		$trip->status = 'Completed';
            		$trip->paykey = $transaction_id ?? '';
            		$trip->payment_status = 'Completed';
            		$trip->save();
            
            		if($trip->pool_id>0) {
            
            			$pool_trip = PoolTrip::with('trips')->find($trip->pool_id);
            			$trips = $pool_trip->trips->whereIn('status',['Scheduled','Begin trip','End trip','Rating','Payment'])->count();
            			
            			if(!$trips) {
            				// update status
            				$pool_trip->status = 'Completed';
            				$pool_trip->save();
            			}
            		}
            
            		$data = [
            			'trip_id' => $trip->id,
            			'correlation_id' => $pay_result->transaction_id ?? '',
            			'driver_payout_status' => ($trip->driver_payout) ? 'Pending' : 'Completed',
            		];
            		Payment::updateOrCreate(['trip_id' => $trip->id], $data);
            
            		//Push notification 
            		$push_title = "Payment Completed";
            		$push_data['push_title'] = $push_title;
                    $push_data['data'] = array(
                    	'trip_payment' => array(
                    		'status' => 'Paid',
                    		'trip_id' => $trip->id,
                    		'rider_thumb_image' => $trip->rider_profile_picture
                    	)
                    );
                    $request_helper = new RequestHelper();
                    $request_helper->SendPushNotification($trip->driver,$push_data);
            
            	
            		$paymentData = ([
    				'status_code' => '1',
    				'status_message' 	=> __('messages.payment_complete_success'),
        			]);
        			return $this->returnView($paymentData);
			        
			        
			    }
			    
			}
		
			

		} else{
			$paymentData = ([
				'status_code' => '0',
				'status_message' => trans('This Transaction was not successfull, kindly try again later'),
			]);
			return $this->returnView($paymentData);
		}   
       
	}

	 public function returnView($payment_status)
	{
		return view('web_payment.view',compact('payment_status'));
	}


	public function setUserLocale($locale)
	{
		App::setLocale($locale);
        Session::put('language', $locale);
	}


}