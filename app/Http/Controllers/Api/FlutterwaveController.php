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
class FlutterwaveController extends Controller
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

	
	 public static function flutterwave(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $payment_id = uniqid();
        
       
      
        $data['amount'] =  $request->amount;
		$data['currency_code'] = $user->currency_code;
		$data['payment_type'] = 'mpesa';
		$data['pay_for'] = $request->pay_for;
		$data['token'] = $request->token;
		$data['user_id'] = $user->id;
		
		return view('payment.flutterwave',$data);
    
    }
    public function flutterwave_payment(Request $request)
	{
        $curl = curl_init();
        $email=$request->email;
        $amount=$request->amount;
    
        $customer_email = $email; 
        $amount_pay = $amount;
        $currency = $request->currency_code;
        $txref = "rave" . uniqid(); // ensure you generate unique references per transaction.
        
        //Store the transcation data to the database
        $Transaction = new Transaction();
        $Transaction->user_id =$request->user_id;
        $Transaction->payment_id =$txref;
        $Transaction->amount = $request->amount;
        $Transaction->payment_type = "flutterwave";
        $Transaction->currency =  $request->currency_code;
        $Transaction->pay_for = $request->pay_for;
        $Transaction-> save();
        // get your public key from the dashboard.
        $PBFPubKey = payment_gateway('public_key','Flutterwave');
        $redirect_url = "https://new.newtaxi.co/api/flutterwave_callback?email=$email&amount=$amount_pay"; // Set your own redirect URL
    
         curl_setopt_array($curl, array(
         CURLOPT_URL => "https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/hosted/pay",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_CUSTOMREQUEST => "POST",
         CURLOPT_POSTFIELDS => json_encode([
            'amount'=>$amount_pay,
            'customer_email'=>$customer_email,
            'currency'=>$currency,
            'txref'=>$txref,
            'PBFPubKey'=>$PBFPubKey,
            'redirect_url'=>$redirect_url,
          ]),
          CURLOPT_HTTPHEADER => [
            "content-type: application/json",
            "cache-control: no-cache"
          ],
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        if($err){
          // there was an error contacting the rave API
          die('Curl returned error: ' . $err);
        }
    
        $transaction = json_decode($response);
    
        if(!$transaction->data && !$transaction->data->link){
          // there was an error from the API
          print_r('API returned error: ' . $transaction->message);
        }
    
        // redirect to page so User can pay
    
        header('Location: ' . $transaction->data->link); 
    
   } 
   
  
   public function futterwave_callback( Request $request ) {
       
     $postData = request()->input('resp');
    $data = json_decode($postData, true);

    // Extract the required data
    $txRef = $data['tx']['txRef'];
    $raveRef = $data['tx']['raveRef'];
    $amount = $data['tx']['amount'];
    //$email = $data['tx']['customer']['email'];
    $responseCode = $data['tx']['chargeResponseCode'];
    $status = $data['tx']['status'];
    $currency = $data['tx']['currency'];
    

		if ($responseCode == "00") {
			$transaction_id = $txRef;
			$flutterwave_payment = Transaction::where('payment_id',$txRef)->where('status','Pending')->latest()->first();
			$user = User::where('id',$flutterwave_payment->user_id)->first();
		
		
			if($flutterwave_payment){
			    $flutterwave_transaction = Transaction::find($flutterwave_payment->id);
			    
    			if ($flutterwave_transaction) {
                    $flutterwave_transaction->status = 'Paid'; // Set the new value for the status
                    $flutterwave_transaction->transaction_id =  $raveRef;
                    $flutterwave_transaction->payment_desc =  $status;
                    $flutterwave_transaction->save(); // Save the changes to the database
                }
			    if($flutterwave_payment->pay_for=="wallet"){
			        
			        
			        $wallet = Wallet::whereUserId($flutterwave_payment->user_id)->first();
			        

                    $wallet_amount = $flutterwave_payment->amount;
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
				     'status_code' => '1',
					 'status_message' 	=> __('messages.wallet_add_success'),
					 'wallet_amount' 	=>  (string) floatval($wallet_amount),
			        ]);
			        return $this->returnView($paymentData);
			        
			    }else if($flutterwave_payment->pay_for=="pay_to_admin"){
			        
			      $owe_amount = DriverOweAmount::where('user_id', $user->id)->first();
		if ($owe_amount && $owe_amount->amount > 0) {
		

			//pay to admin from payout preference start
			$owe_amount = DriverOweAmount::where('user_id', $user->id)->first();

			$amount = $flutterwave_payment->amount;


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
				$payment->amount = $flutterwave_payment->amount;
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
	        	}
			        
			      $paymentData = ([
				 'status_code' => '0',
			     'status_message' => __('messages.api.not_generate_amount'),
			     ]);
                 return $this->returnView($paymentData);   
			        
			        
			        
			    }else if($flutterwave_payment->pay_for=="trip"){
			        $trip_id = Trips::where('user_id',$user->id)->where('payment_status',"Pending")->where('payment_mode',"paytm")->latest();
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
		
			

		} else if($responseCode !="00" ){
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