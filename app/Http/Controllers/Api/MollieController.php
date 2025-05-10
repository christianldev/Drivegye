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
use Mollie\Laravel\Facades\Mollie;
class MollieController extends Controller
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


	public function activePaymentMethod()
	{
		$payment_gateway = resolve('payment_gateway');
		return $payment_gateway->where('site','!=','Cash')->where('name','is_enabled')->where('value','1')->pluck('site');
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




	
	
	 public static function mollie(Request $request)
     {
        $user = JWTAuth::parseToken()->authenticate();
        $userId = $user->id;
        $payment_id = uniqid();
        $amount = $request->amount;
        $currency_code = $user->currency_code;
        $amountFormatted = number_format($amount, 2);
        if($currency_code!="EUR"){
         $amountFormatted = currencyConvert($user->currency_code,"EUR",request()->amount);
        }
        // Get keys
        $public_key = payment_gateway('api_key','Mollie');
        $callback = payment_gateway('callback_url','Mollie');
        $webhook = payment_gateway('webhook_url','Mollie');
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.mollie.com/v2/payments",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_POST => true,
          CURLOPT_POSTFIELDS => http_build_query([
            "amount[currency]" => "$currency_code",
            "amount[value]" => "$amountFormatted",
            "description" => "Order $payment_id",
            "redirectUrl" => "$callback?userId=$userId",
            "webhookUrl" => "$webhook",
            "metadata" => json_encode(["order_id" => "$payment_id"])
          ]),
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer $public_key"
          ]
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        //Store transaction on database
		$mollie= new Transaction();
        $mollie->user_id =$user->id;
        $mollie->payment_id = $payment_id;
        $mollie->payment_type = "mollie";
        $mollie->currency =  $user->currency_code;
        $mollie->amount = $request->amount;
        $mollie->pay_for = $request->pay_for;
        $mollie-> save();
        
        if ($error) {
        echo "cURL Error: " . $error;
        } else {
          $decodedResponse = json_decode($response, true);
           // redirect customer to Mollie checkout page
          if (isset($decodedResponse['_links']['checkout']['href'])) {
            $checkoutUrl = $decodedResponse['_links']['checkout']['href'];
            header("Location: $checkoutUrl");
            exit();
          } else {
            echo "Checkout URL not found in the response.";
          }
        }
   
         
    
    }
   
   public function mollie_callback(Request $request) {
       
        $ifsuccessful = false;
        $response = null;
        $user_id = $request->query('userId');
        $user =User::where('id',$user_id)->first();
        // set Execution Time
        $start = microtime(true);
    
        while (!$ifsuccessful) {
            // Run your query here
            $result = Transaction::where('user_id', $user_id)->latest()->first(); 
    
            // Check if the condition is met
            if ($result && $result->status == 'Failed') {
                $ifsuccessful = true;
                 $response  = ([
    				'status_code' => '0',
    				'status_message' => trans($result->payment_desc),
    			]);
    			return $this->returnView($response);
               
            } else if($result && $result->status == 'Paid') {
                 if($result->pay_for=="wallet"){
    			        
    			        
    			        $wallet = Wallet::whereUserId($result->user_id)->first();
    			        
    
                        $wallet_amount = $result->amount;
                		if($wallet) {
                			$wallet_amount = floatval($wallet->original_amount) + floatval($wallet_amount);
                		}
                		else {
                			$wallet = new Wallet;
                		}
                
                		$wallet->amount = $wallet_amount;
                		$wallet->paykey = $result->transaction_id;
                		$wallet->currency_code = $user->currency_code;
                		$wallet->user_id = $user_id;
                		$wallet->save();
                
                	
    			         $paymentData = ([
    				     'status_code' => '1',
    					 'status_message' 	=> __('messages.wallet_add_success'),
    					 'wallet_amount' 	=>  (string) floatval($wallet_amount),
    			        ]);
    			        return $this->returnView($paymentData);
    			        
    			    }else if($result->pay_for=="pay_to_admin"){
    			        
    			        $owe_amount = DriverOweAmount::where('user_id', $user_id)->first();
                		if ($owe_amount && $owe_amount->amount > 0) {
                		
                
                			//pay to admin from payout preference start
                			$owe_amount = DriverOweAmount::where('user_id', $user_id)->first();
                
                			$amount = $result->amount;
                
                
                			if($amount > 0) {
                				if($owe_amount->amount < $amount) {
                				
                					$paymentData = ([
                				    'status_code' => '0',
                					'status_message' => trans('messages.api.invalid'),
                					
                			        ]);
                			        return $this->returnView($paymentData);
                				}
                
                
                				$owe_amount = DriverOweAmount::where('user_id', $user_id)->first();
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
                				$payment->transaction_id = $result->transaction_id;
                				$payment->amount = $result->amount;
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
                			        
                			        
                			        
    			    }else if($result->pay_for=="trip"){
    			        $trip_id = Trips::where('user_id',$user->id)->where('payment_status',"Pending")->where('payment_mode',"mollie")->latest()->first();
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
                		$trip->paykey = $result->transaction_id ?? '';
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
    		
    		$elapsedTime = microtime(true) - $start; // Calculate elapsed time in seconds
    
            // Check if the timeout duration (in seconds) has been exceeded
            $timeout = 20; // Set your desired timeout duration in seconds
            if ($elapsedTime >= $timeout) {
                $paymentData = ([
        				'status_code' => '0',
        				'status_message' 	=> __('Payment was not successful, kindly try again!'),
            			]);
            	return $this->returnView($paymentData);
            }
        }
	}

	public function webhook(Request $request){
	    
        $id = $request->id;
        $curl = curl_init();
        
        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.mollie.com/v2/payments/$id",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_HTTPHEADER => [
            "Authorization: Bearer  test_cucfwKTWfft9s337qsVfn5CC4vNkrn"
          ]
        ]);
        
        $response = curl_exec($curl);
        $error = curl_error($curl);
        
        curl_close($curl);
        $decodedResponse = json_decode($response, true);
        if ($decodedResponse === null) {
        echo "Unable to decode the response.";
        } else {
            $paymentId = $decodedResponse['id'];
            $orderId = json_decode($decodedResponse['metadata'], true)['order_id'];
            $status = $decodedResponse['status'];
        
            $Transaction= Transaction::where('payment_type',"mollie")->where('payment_id',$orderId)->where('status',"Pending")->latest()->first();
            if($Transaction){
            $user = $Transaction->user_id;
            $mollie_transaction = Transaction::find($Transaction->id); // Find the record with id = 1
            }
            if($status=="paid"){
           
            // Extract relevant data from the callback
            
                if ($mollie_transaction) {
                    $mollie_transaction->status = 'Paid'; // Set the new value for the status
                    $mollie_transaction->transaction_id =  $paymentId;
                    $mollie_transaction->payment_desc =  "Successfully Paid";
                    $mollie_transaction->save(); // Save the changes to the database
                }
            
            }
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