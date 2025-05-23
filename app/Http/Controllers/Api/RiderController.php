<?php

/**
 * Rider Controller
 *
 * @package     NewTaxi Prime
 * @subpackage  Controller
 * @category    Rider
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\CarType;
use App\Models\DriverLocation;
use App\Models\EmergencySos;
use App\Models\Request as RideRequest;
use App\Models\RiderLocation;
use App\Models\ScheduleRide;
use App\Models\Trips;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Banner;
use App\Models\Country;
use App\Models\PeakFareDetail;
use App\Models\Location;
use App\Models\ReferralUser;
use App\Models\ManageFare;
use App\Models\CancelReason;
use App\Models\ScheduleCancel;
use App\Models\PoolTrip;
use App\Models\FilterObject;
use App\Models\Support;
use App\Models\SupportDriver;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App;
use DB;
use JWTAuth;
use Validator;

class RiderController extends Controller
{
	public function __construct()
	{
		$this->request_helper = resolve("App\Http\Helper\RequestHelper");
	}

	/**
	 * Rider Request to Search Cars
	 * @param  Get method request inputs
	 *
	 * @return Response Json
	 */
	public function searchCars(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();

		$rules = array(
			'pickup_latitude' 	=> 'required',
			'pickup_longitude' 	=> 'required',
			'drop_latitude' 	=> 'required',
			'drop_longitude' 	=> 'required',
			'user_type' 		=> 'required|in:Rider,rider',
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
            return response()->json([
            	'status_code' => '0',
            	'status_message' => $validator->messages()->first()
            ]);
        }

		if($request->timezone) {
			date_default_timezone_set($request->timezone);
			$current_time = date('H:i:00');
		}

		$current_time = date('H:i:00');
		$day = date('N');

		$is_schedule = $request->is_schedule;
		if(isset($request->schedule_date)!='' && $is_schedule=='1') {
			$day = date('N',strtotime($request->schedule_date));
			$current_time = $request->schedule_time.':00';
		}

		$offline_hours = site_settings('offline_hours');
		$minimumTimestamp = Carbon::now('UTC')->subHours($offline_hours);

		$fare_estimation = 0;
		$get_near_car_time = 0;

		// Find location from pickup latitude & longitude
		$match_location = Location::select(
			DB::raw("id,status,(ST_WITHIN( ST_GeomFromText('POINT(".$request->pickup_latitude.' '.$request->pickup_longitude.")'),ST_GeomFromText(coordinates))) as available ")
		)->having('available','1')->where('status','Active')->first();

		if(!$match_location) {
            return response()->json([
				'status_message' => trans('messages.location_unavailable'),
				'status_code' => '0',
			]);
		}

		$location_cars = ManageFare::where('location_id',$match_location->id)->get()->toArray();
		
		

        $vehicles 	= array_column($location_cars,'vehicle_id');
        $location_id= $match_location->id;

        $lat_lng_array = [
        	"pickup_latitude" 	=> $request->pickup_latitude,
        	"pickup_longitude" 	=> $request->pickup_longitude,
        	"drop_latitude" 	=> $request->drop_latitude,
        	"drop_longitude" 	=> $request->drop_longitude,
        ];


        $handicap = $child_seat = $request_from = '';
		$options = FilterObject::options('rider',$user_details->id);
		if(in_array('4', $options)) {
			$request_from = '1';
		}
		if(in_array('2', $options)) {
			$handicap = '1';
		}
		if(in_array('3', $options)) {
			$child_seat = '1';
		}

		// Find nearest cars in location
		$nearest_car = DriverLocation::select(
			DB::raw('*, ( 6371 * acos( cos( radians(' . $request->pickup_latitude . ') ) * cos( radians( latitude ) ) * cos(radians( longitude ) - radians(' . $request->pickup_longitude . ') ) + sin( radians(' . $request->pickup_latitude . ') ) * sin( radians( latitude ) ) ) ) as distance')
		)
		->with([
			'car_type'=>function($q) use($location_id) {
				$q->with(['manage_fare'  => function($q) use($location_id) {
					$q->where('location_id',$location_id);
				}]);
			},
			'users',
			'pool_trip'
		])
		->where('updated_at','>=', $minimumTimestamp)
		->where(function($query) use($is_schedule) {
			if($is_schedule!='1'){
				$query->where('status', 'Online')->orWhere('status','Pool Trip');
			}
		})
		->whereHas('users', function($q1) use($handicap,$child_seat,$request_from,$user_details) {
			$q1->activeOnlyStrict()
			->whereHas('vehicle', function($q2) use($handicap,$child_seat,$request_from,$user_details) {
				if($handicap) {
					$q2->whereHas('handicap');
				}
				if($child_seat) {
					$q2->whereHas('child_seat');
				}
				if($request_from) {
					$q2->whereHas('female_driver');
				}
				if($user_details->gender=='1') {
					$q2->whereDoesntHave('female');
				}
			});
		})
		->whereHas('car_type', function($q2) use ($vehicles,$is_schedule) {
			$q2->where('status', 'Active')->whereIn('car_id',$vehicles);
			if($is_schedule=='1')
				$q2->where('is_pool', 'No');
		})
		
		->havingRaw(('case WHEN status="Online" THEN distance<='.site_settings('driver_km').' ELSE distance<='.site_settings('pickup_km').' END'))
		->orderBy('distance', 'ASC')
		->take(5)
		->get();

		if($is_schedule!='1') {
			$nearest_car = $nearest_car->filter(function($near_car) use($lat_lng_array) {

				if($near_car->status == "Online") {
					return true;
				}
				
				$pool_trip = $near_car->pool_trip;
				if($pool_trip->seats < 1 || $pool_trip->car_id!=$near_car->car_id) {
					return false;
				}

				// get pending pool trips count
				$pending_trips = $pool_trip->trips->whereIn('status',['Scheduled','Begin trip','End trip']);
				if($pending_trips->count()==1) {
					$pending_trips = array_values($pending_trips->toArray());
					$driver_location_to_drop = getDistanceBetweenPoints($near_car->latitude,$near_car->longitude,$pending_trips[0]['drop_latitude'],$pending_trips[0]['drop_longitude']);
					if($driver_location_to_drop <= site_settings('drop_km')) {
						return true;
					}
				}

				$trip_destinations = PoolTrip::with(['trips' => function($query) use($lat_lng_array) {
					$query->with('driver_location')->select(
						\DB::raw(
							'*,
							(CASE 
							WHEN status="Scheduled" OR status="Begin trip" OR status="End Trip" THEN ( 6371 * acos( cos( radians(' . $lat_lng_array['drop_latitude'] . ') ) * cos( radians( drop_latitude ) ) * cos(radians( drop_longitude ) - radians(' . $lat_lng_array['drop_longitude'] . ') ) + sin( radians(' . $lat_lng_array['drop_latitude'] . ') ) * sin( radians( drop_latitude ) ) ) ) 
							ELSE 999999999 END) as distance'
						)
					)
					->having('distance', '<', site_settings('drop_km'));
				}])
				->find($near_car->pool_trip_id);

				$trip_destinations_count = $trip_destinations->trips->count();

				return ($trip_destinations_count > 0);
			});
		}
		

		$nearest_car = collect($nearest_car)->groupBy('car_id')->values();
		LogDistanceMatrix("Search cars");
		$get_fare_estimation = $this->request_helper->GetDrivingDistance($request->pickup_latitude, $request->drop_latitude, $request->pickup_longitude, $request->drop_longitude);
		if ($get_fare_estimation['status'] != "success") {
			return response()->json([
				'status_code' => '0',
				'status_message' => $get_fare_estimation['msg'],
			]);
		}

		if(!$get_fare_estimation['distance']) {
			return response()->json([
				'status_code' => '0',
				'status_message' => 'Same location'
			]);
		}

		$minutes = round(floor(round($get_fare_estimation['time'] / 60)));
		$km = round(floor($get_fare_estimation['distance'] / 1000) . '.' . floor($get_fare_estimation['distance'] % 1000));
		$additional_rider = fees('additional_rider_fare');
		if (isset($nearest_car) && !$nearest_car->isEmpty()) {

         	/* Start Peak Price */
		 	$data = ManageFare::with([
		 		'peak_fare' => function($query) use($day,$current_time) {
		 			$query->where(function($q) use($day,$current_time) {
		 				$q->where('day', $day)
		 				->whereRaw("(start_time <= '".$current_time."' and end_time >= '".$current_time."')");
		 			})
		 			->orWhere(function($q) use($day,$current_time) {
		 				$q->where('day', null)
		 				->whereRaw(
		 					"(SELECT CASE WHEN ( start_time < end_time ) THEN (start_time <= '".$current_time."' and end_time >= '".$current_time."') ELSE (('".$current_time."' between start_time and '23:59:00') or ('".$current_time."' between '00:00:00' and end_time)) END)"
		 				);
		 			});
		 		}
		 	])
		 	->whereHas('peak_fare',function($query) use($day,$current_time) {
		 		$query->where(function($q) use($day,$current_time) {
		 			$q->where('day', $day)
		 			->whereRaw("start_time <= '".$current_time."' and end_time >= '".$current_time."'");
		 		})
		 		->orWhere(function($q) use($day,$current_time) {
		 			$q->where('day', null)
		 			->whereRaw(
		 				"(SELECT CASE WHEN ( start_time <= end_time ) THEN (start_time <= '".$current_time."' and end_time >= '".$current_time."') ELSE (('".$current_time."' between start_time and '23:59:00') or ('".$current_time."' between '00:00:00' and end_time)) END)"
		 			);
		 		});
		 	})
		 	->where('location_id',$location_id)
		 	->groupBy('vehicle_id')
		 	->get();

			$fare_details = $data->mapWithKeys(function($fare) {
				$peak_fare = $fare->peak_fare->first();
				$fare_data = array(
					'id' 		=> $peak_fare->id,
					'car_id' 	=> $fare->vehicle_id,
					'price' 	=> $peak_fare->price,
					'type'		=> $peak_fare->type,
				);
				return [$fare->vehicle_id => $fare_data];
			})->toArray();
			/* End Peak Price */

			$location = $drivers = array();
			$i = 0;
			foreach ($nearest_car as $key => $list_car) {

				$location = $list_car->map(function ($item) use ($km, $minutes) {
					return array(
						'latitude' => $item->latitude,
						'longitude' => $item->longitude
					);
				})->toArray();

				$drivers = $list_car->map(function ($item) use ($km, $minutes) {
					return array(
						'id' => $item->user_id,
					);
				})->toArray();

				if (count($location) > 0) {
					LogDistanceMatrix("Search cars","first nearest driver");
					$get_min_time = $this->request_helper->GetDrivingDistance($request->pickup_latitude, $location[0]['latitude'], $request->pickup_longitude,$location[0]['longitude']);

					$base_fare = round($list_car[$i]->car_type->manage_fare->base_fare + ($list_car[$i]->car_type->manage_fare->per_km * $km));
					$fare_estimation = number_format(($base_fare + round($list_car[$i]->car_type->manage_fare->per_min * $minutes)), 2, '.', '');

					if($fare_estimation < $list_car[$i]->car_type->manage_fare->min_fare) {     
                        $fare_estimation = $list_car[$i]->car_type->manage_fare->min_fare;
					}

					if($get_min_time['status'] != "success") {
						return response()->json([
							'status_code' => '0',
							'status_message' => $get_min_time['msg'],
						]);
						
					}
					$get_near_car_time = round(floor(round($get_min_time['time'] / 60)));
					if($get_near_car_time == 0) {
						$get_near_car_time = 1;
					}
				}
				
             	$car_s[]  = array('car_id' => $list_car[$i]->car_id);

				$peak_price = 0;
				$apply_peak = "No";
				$peak_id =0;

             	if(!empty($fare_details)) {
                	if(array_key_exists($list_car[$i]->car_id,$fare_details)) { 
	                 	$peak_price = $fare_details[$list_car[$i]->car_id]['price'];
	                 	$peak_id = $fare_details[$list_car[$i]->car_id]['id'];
	                 	$apply_peak = "Yes";
	                 	$fare_estimation = $fare_estimation * $peak_price;
                 	}
              	}

              	$additional_rider_amount = 0;
				if(isset($request->seat_count) && $request->seat_count > 1 ) {
				    $additional_rider_amount = number_format(($additional_rider / 100) *  $fare_estimation , 2, '.', '');
				    $fare_estimation += $additional_rider_amount;
				}

              	$car_fare = $list_car[$i]->car_type->manage_fare;

			 	$car_array[$list_car[$i]->car_id] = array( 
				    'car_id' 		=> $list_car[$i]->car_id,
					'car_name' 		=> $list_car[$i]->car_type->car_name,
					'is_pool' 		=> ($car_fare->capacity > 1 && $list_car[$i]->car_type->is_pool == "Yes"),
					'driver_id' 	=> $list_car[$i]->user_id,
					'capacity' 		=> $car_fare->capacity,
					'base_fare' 	=> $car_fare->base_fare,
					'waiting_time' 	=> $car_fare->waiting_time,
					'waiting_charge'=> $car_fare->waiting_charge,
					'per_min' 		=> $car_fare->per_min,
					'per_km' 		=> $car_fare->per_km,
					'min_fare' 		=> $car_fare->min_fare,
					// 'schedule_fare' => $car_fare->schedule_fare,
					// 'schedule_cancel_fare' => $car_fare->schedule_cancel_fare,
					'location' 		=> $location,
					'drivers' 		=> $drivers,
					'fare_estimation' => (string) $fare_estimation ,
					'min_time' 		=> (string) $get_near_car_time,
					'apply_peak' 	=> $apply_peak,
					'peak_price' 	=> $peak_price,
					'location_id' 	=> $location_id,
					'additional_rider_percentage' => $additional_rider,
					'peak_id' 		=> $peak_id,
					'car_image' 	=> $list_car[$i]->car_type->vehicle_image,
					'car_active_image' =>$list_car[$i]->car_type->active_image,
				);
			}
		}
		
		if($request->car_type!=null){
		    
    		$carType = CarType::where('car_name',$request->car_type)->first();
            if ($carType) {
                $carTypeId = $carType->id;
                $carTypeIdArray = [$carTypeId];
                // Use the $carTypeId as needed
            }
		   	$cars = CarType::with(['manage_fare' =>function($q) use ($location_id) {
			$q->where('location_id',$location_id);
    		}])
    		->whereIn('id', $carTypeIdArray)
    		->where('status', 'Active');
		}else{
		    $cars = CarType::with(['manage_fare' =>function($q) use ($location_id) {
			$q->where('location_id',$location_id);
    		}])
    		->whereIn('id',$vehicles)
    		->where('status', 'Active');
		}

	

		if($is_schedule=='1') {
			$cars->where('is_pool', 'No');
		}

		if(isset($car_s)) {
			$car_id = array_column($car_s, 'car_id');
			$cars = $cars->whereNotIn('id', $car_id)->get();
		} else {
			$cars = $cars->get();
		}

		foreach($cars as $key => $value) {
			$base_fare = round($value->manage_fare->base_fare + ($value->manage_fare->per_km * $km));
			$fare_estimation = number_format(($base_fare + round($value->manage_fare->per_min * $minutes)), 2, '.', '');

			if($fare_estimation < $value->manage_fare->min_fare) {     
	            $fare_estimation = $value->manage_fare->min_fare;
			}

			$car_array[$value->id] = [
				'car_id' 		=> $value->id,
				'car_name' 		=> $value->car_name,
				'is_pool' 		=> ($value->manage_fare->capacity > 1 && $value->is_pool == "Yes"),
				'driver_id' 	=> 0,
				'capacity' 		=> $value->manage_fare->capacity,
				'base_fare' 	=> $value->manage_fare->base_fare,
				'waiting_time' 	=> $value->manage_fare->waiting_time,
				'waiting_charge'=> $value->manage_fare->waiting_charge,
				'per_min' 		=> $value->manage_fare->per_min,
				'per_km' 		=> $value->manage_fare->per_km,
				'min_fare' 		=> $value->manage_fare->min_fare,
				'schedule_fare' => $value->manage_fare->schedule_fare,
				'schedule_cancel_fare' => $value->manage_fare->schedule_cancel_fare,
				'location' 		=> array(),
				'drivers' 		=> array(),
				'fare_estimation' => $fare_estimation,
				'additional_rider_percentage' => $additional_rider,
				'min_time'		=> 'No cabs',
				"apply_peak"	=> "No",
                "peak_price" 	=> 0,
                'location_id' 	=> $location_id,
				'peak_id' 		=>  0,								
			    'car_image' 	=> $value->vehicle_image,
				'car_active_image' => $value->active_image,
			];
		}

		if(!isset($car_array)) {
			return response()->json([
				'status_message' => trans('messages.no_cars_found'),
				'status_code' => '0',
			]);
		}

		return response()->json([
			'nearest_car' => $car_array,
			'status_message' => trans('messages.cars_found'),
			'status_code' => '1',
		]);
	}

	/**
	 * Update Location of Rider
	 *
	 * @param Get method request inputs
	 * @return @return Response in Json
	 */
	public function updateriderlocation(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();

		$rules = array(
			'latitude' => 'required',
			'longitude' => 'required',
		);

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json([
            	'status_code' => '0',
            	'status_message' => $validator->messages()->first()
            ]);
		}
		$user_check = User::where('id', $user_details->id)->first();

		if ($user_check == '') {
			return response()->json([
				'status_code'	 => '0',
				'status_message' => __('messages.invalid_credentials'),
			]);
		}

		$data = [
			'user_id' => $user_details->id,
			'latitude' => $request->latitude,
			'longitude' => $request->longitude,
		];

		RiderLocation::updateOrCreate(['user_id' => $user_details->id], $data);

		return response()->json([
			'status_code' => '1',
			'status_message' => 'Updated Successfully',
		]);
	}
	
	
	public function transfer_money(Request $request)
	{
	    $user_details = JWTAuth::parseToken()->authenticate();
	    

	    
	    //Check Account number
	    $checkAccount = Wallet::where('accountno', $request->account_number)->first();
	    if($checkAccount==NULL){
	      return [
			'status_code' 		=> '0',
			'status_message' 	=> __('Wrong Account Number, kindly confirm and try again!'),
			
		    ];  
	    }
	    //If Account Number Entered by user belongs to his account
	    $wallet = Wallet::whereUserId($user_details->id)->first();
	    if($wallet){
	         if($wallet->accountno == $request->account_number){
	           return [
    			'status_code' 		=> '0',
    			'status_message' 	=> __('Sorry! You can\'t transfer money to your own wallet'),
    			
    		    ];
	         }
	    }
	   
	    //Check Wallet
	    
	    if($wallet==NULL || $wallet->amount < $request->amount){
	        
	        return [
			'status_code' 		=> '0',
			'status_message' 	=> __('Insufficient Wallet Amount!'),
			
		    ];
	        
	    }
	    //Let's generate unique transaction code for each transaction
	    $randomCode = Str::random(8);
	    $wallet_amount = $request->amount;
	    if($checkAccount) {
			$wallet_amount = floatval($checkAccount->amount) + floatval($wallet_amount);
			// Update Amount sent to user account
            $checkAccount->amount = $wallet_amount;
            $checkAccount->paykey = $randomCode;
            $checkAccount->currency_code = $checkAccount->currency_code;
            $checkAccount->user_id = $checkAccount->user_id;
            $checkAccount->save();
		}
		$randomNumber = rand(100, 999);
		if($wallet->accountno < 1){
		    $wallet->accountno =$user_details->id.$randomNumber;
    		$wallet->save();
		}
		
	
		
	    if($wallet) {
			$wallet_remaining = floatval($wallet->amount) - floatval($request->amount);
			//Update wallet 
    		$wallet->amount =$wallet_remaining;
    		$wallet->paykey = $randomCode;
    		$wallet->currency_code = $user_details->currency_code;
    		$wallet->user_id = $user_details->id;
    		$wallet->save();
    		
    		return [
			'status_code' 		=> '1',
			'status_message' 	=> __('Wallet Amount Transfered Successfully'),
			'wallet_amount' 	=>  (string) floatval($wallet_remaining),
		    ];
		}
		    /*$push_title = "Wallet Amount Successfully Transferred ";   
		
		    $data['title'] = $push_title;

            $firbase = resolve("App\Services\FirebaseService");
            $firbase_ref = $firbase->updateReference("Notification/".$user_details->id, json_encode(['custom'=>$data]));*/
	

	}

	/**
	 * Ride Request from Rider
	 * @param  Get method request inputs
	 *
	 * @return Response Json
	 */
	public function requestCars(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();

		$rider_id = $user_details->id;

		if ($request->request_id) {
			$rules = array(
				'status' => 'required|in:Cancelled,cancelled',
			);
		}
		else {
			$rules = array(
				'pickup_latitude' => 'required',
				'pickup_longitude' => 'required',
				'drop_latitude' => 'required',
				'drop_longitude' => 'required',
				'user_type' => 'required|in:Rider,rider',
				'car_id' => 'required|exists:car_type,id',
				'pickup_location' => 'required',
				'drop_location' => 'required',
				'device_id' => 'required',
				'device_type' => 'required',
				'payment_method' => 'required',
			);
			$group_id = '';
		}

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json([
            	'status_code' => '0',
            	'status_message' => $validator->messages()->first()
            ]);
		}

		$additional_fare = "";
		$peak_price = 0;

		if(isset($request->peak_id)!='') {
			$fare = PeakFareDetail::find($request->peak_id);
			if($fare) {
				$peak_price = $fare->price; 
				$additional_fare = "Peak";
			}
		}

		$additional_rider = fees('additional_rider_fare');

		if ($request->request_id) {
			RideRequest::where('id', $request->request_id)->update(['status' => $request->status]);

			$ride_request = RideRequest::where('id', $request->request_id)->first();

			$data = [
				'rider_id' => $ride_request->user_id,
				'pickup_latitude' => $ride_request->pickup_latitude,
				'pickup_longitude' => $ride_request->pickup_longitude,
				'drop_latitude' => $ride_request->drop_latitude,
				'drop_longitude' => $ride_request->drop_longitude,
				'user_type' => $ride_request->user_type,
				'car_id' => $ride_request->car_id,
				'driver_group_id' => $ride_request->group_id,
				'pickup_location' => $ride_request->pickup_location,
				'drop_location' => $ride_request->drop_location,
				'payment_method' => $ride_request->payment_method,
				'is_wallet' => $ride_request->is_wallet,
				'timezone' => $ride_request->timezone,
				'schedule_id' => $ride_request->schedule_id,
				'additional_fare'  =>$additional_fare,
				'location_id' => $ride_request->location_id,
				'peak_price'  => $peak_price,
				'additional_rider'  => $additional_rider,
				'trip_path'  	=> $ride_request->trip_path,
				'fare_estimation'  => $request->fare_estimation ?? '0',
				'seats'  => $ride_request->seats ?? '1',
			];

			$car_details = $this->request_helper->find_driver($data);

			return $car_details;
		}

		User::whereId($rider_id)->update(['device_id' => $request->device_id, 'device_type' => $request->device_type]);

		$data = [
			'rider_id' => $rider_id,
			'pickup_latitude' => $request->pickup_latitude,
			'pickup_longitude' => $request->pickup_longitude,
			'drop_latitude' => $request->drop_latitude,
			'drop_longitude' => $request->drop_longitude,
			'user_type' => $request->user_type,
			'car_id' => $request->car_id,
			'driver_group_id' => $request->group_id,
			'pickup_location' => $request->pickup_location,
			'drop_location' => $request->drop_location,
			'payment_method' => $request->payment_method,
			'is_wallet' => $request->is_wallet,
			'timezone' => $request->timezone,
			'schedule_id' => (string) $request->schedule_id,
			'additional_fare' => $additional_fare,
			'additional_rider'  => $additional_rider,
			'location_id' => $request->location_id,				 
			'peak_price'  => $peak_price,
			'trip_path'  	=> $request->polyline ?? '',
			'fare_estimation'  => $request->fare_estimation ?? '0',
			'seats'  => $request->seat_count ?? '1',
		];

		$car_details = $this->request_helper->find_driver($data);

		return $car_details;
	}

	/**
	 * Display the promo details
	 * @param  Get method request inputs
	 *
	 * @return Response Json
	 */
	public function promo_details(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();
		$user = User::where('id', $user_details->id)->first();
		if ($user == '') {
			return response()->json([
				'status_code'	 => '0',
				'status_message' => __('messages.invalid_credentials'),
			]);
		}

		$invoice_helper = resolve('App\Http\Helper\InvoiceHelper');
		$promo_details = $invoice_helper->getUserPromoDetails($user_details->id);

		$wallet_amount = getUserWalletAmount($user_details->id);

		$user = array(
			'status_code' 	=> '1',
			'status_message'=> __('messages.api.success'),
			'wallet_amount' => $wallet_amount,
			'promo_details' => $promo_details,
			// 'brand'     	=> '',
			// 'last4'     	=> '',
			'stripe_key' 	=> STRIPE_KEY,
		);
		return response()->json($user);
	}

	/**
	 * Track the Driver Location
	 * @param  Get method request inputs
	 *
	 * @return Response Json
	 */
	public function track_driver(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();

		$rules = array(
			'user_type' => 'required',
			'trip_id' => 'required|exists:trips,id',
		);

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json([
                'status_code'     => '0',
                'status_message' => $validator->messages()->first(),
            ]);
		}
		$user = User::where('id', $user_details->id)->first();

		if (!$user) {
			return response()->json([
				'status_code'	 => '0',
				'status_message' => __('messages.invalid_credentials'),
			]);
		}

		$driver_details = Trips::where('id', $request->trip_id)->first();
		$driver_latitude = $driver_details->driver_location->latitude;
		$driver_longitude = $driver_details->driver_location->longitude;

		$user = array(
			'status_code' => '1',
			'status_message' => 'Success',
			'driver_latitude' => $driver_latitude,
			'driver_longitude' => $driver_longitude,
		);

		return response()->json($user);
	}

	/**
	 * Display the SOS details
	 * @param  Get method request inputs
	 * @return Response Json
	 */
	public function sos(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();
		$user = User::where('id', $user_details->id)->first();
		$count = EmergencySos::where('user_id', $user_details->id)->get()->count();

		if ($request->input('mobile_number') != '') {
			$request->replace(array('mobile_number' => preg_replace("/[^\w]+/", "", $request->input('mobile_number')), 'action' => $request->input('action'), 'name' => $request->input('name'),'country_code' => $request->input('country_code'), 'id' => $request->input('id')));
		}

		if ($request->action != "view") {
			$rules = array('mobile_number' => 'required|numeric', 'action' => 'required');
			$validator = Validator::make($request->all(), $rules);

			if ($validator->fails()) {
				return response()->json([
	                'status_code'     => '0',
	                'status_message' => $validator->messages()->first(),
	            ]);
			}
		}
		$user = User::where('id', $user_details->id)->first();

		if (!$user) {
			return response()->json([
				'status_code'	 => '0',
				'status_message' => __('messages.invalid_credentials'),
			]);
		}

		$mobile_number = $request->mobile_number;
		$emer = EmergencySos::where('mobile_number', $mobile_number)->where('user_id', $user_details->id)->first();
		$count = EmergencySos::where('user_id', $user_details->id)->get()->count();
		$contact_details = EmergencySos::where('user_id', $user_details->id)->get();
		if ($request->action == 'update') {
			if ($emer) {
				return response()->json(['status_message' => trans('messages.mobile_number_exist'), 'status_code' => '0', 'contact_count' => $count, 'contact_details' => $contact_details]);
			}

			$emercency = new EmergencySos;
			$emercency->name = $request->name;

			$country = Country::whereShortName($request->country_code)->first();
			$emercency->country_code = $country->phone_code;
			$emercency->country_id 	= $country->id;

			$emercency->mobile_number = $mobile_number;
			$emercency->user_id = $user_details->id;
			$emercency->save();
			$count = EmergencySos::where('user_id', $user_details->id)->get()->count();
			$contact_details = EmergencySos::where('user_id', $user_details->id)->get();
			return response()->json(['status_message' => "Added Successfully", 'status_code' => '1', 'contact_count' => $count, 'contact_details' => $contact_details]);
		}
		else if ($request->action == 'delete') {
			$del = EmergencySos::find($request->id);

			if ($del == null) {
				return response()->json(['status_message' => "Not found given request", 'status_code' => '0', 'contact_count' => $count, 'contact_details' => $contact_details]);
			}

			$del->delete();
			$count = EmergencySos::where('user_id', $user_details->id)->get()->count();
			$contact_details = EmergencySos::where('user_id', $user_details->id)->get();

			return response()->json(['status_message' => "Delete Successfully", 'status_code' => '1', 'contact_count' => $count, 'contact_details' => $contact_details]);
		}
		else {
			return response()->json(['status_message' => trans('messages.success'), 'status_code' => '1', 'contact_count' => $count, 'contact_details' => $contact_details]);
		}
	}

	/**
	 * SOS alert Message to Admin and Rider Added Mobile numbers
	 * @param  Get method request inputs
	 * @return Response Json
	 */
	public function sosalert(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();
		$contact_details = EmergencySos::where('user_id', $user_details->id)->get();
		$address = $this->request_helper->GetLocation($request->latitude, $request->longitude);

		if ($address == '') {
			sleep(5);
			$address = $this->request_helper->GetLocation($request->latitude, $request->longitude);
		}

		$admin_details = Admin::where('status', 'Active')->select('country_code','mobile_number')->first();
		$mobile = '+'.$admin_details->country_code.$admin_details->mobile_number;

		$message = 'Emercency Message';
		$message .= ' From : ' . $user_details->mobile_number;
		$message .= ' Address : ' . $address;
		$sms_gateway = resolve("App\Contracts\SMSInterface");
		if ($contact_details->count() > 0) {
			foreach ($contact_details as $details) {
				$sms_gateway->send('+'.$details->mobile_number,$message);
			}
			$sms_gateway->send($mobile,$message);
			return response()->json(['status_message' => 'Success', 'status_code' => '1']);
		}
		$sms_gateway->send($mobile,$message);
		return response()->json(['status_message' => 'Success', 'status_code' => '2']);
	}

	/**
	 * Save Schedule Ride
	 * @param  Get method request inputs
	 * @return Response Json
	 */
	public function save_schedule_ride(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();
		$rider_id = $user_details->id;
		if ($request->schedule_id != '') {
			$rules = array(
				'schedule_id' => 'required',
				'schedule_date' => 'required',
				'schedule_time' => 'required',
			);
		}
		else {
			$rules = array(
				'schedule_date' => 'required',
				'schedule_time' => 'required',
				'pickup_longitude' => 'required',
				'pickup_latitude' => 'required',
				'drop_latitude' => 'required',
				'drop_longitude' => 'required',
				'car_id' => 'required|exists:car_type,id',
				'pickup_location' => 'required',
				'drop_location' => 'required',
				'device_id' => 'required',
				'payment_method' => 'required',
			);
		}

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return response()->json([
                'status_code'     => '0',
                'status_message' => $validator->messages()->first(),
            ]);
		}

		$status_code = "1";
		if ($request->schedule_id) {
			$schedule_ride = ScheduleRide::find($request->schedule_id);
			$schedule_ride->schedule_date = date('Y-m-d', strtotime($request->schedule_date));
			$schedule_ride->schedule_time = $request->schedule_time;
			$schedule_ride->status = 'Pending';

			$schedule_ride->fare_estimation = ScheduleRide::getFareEstimation($schedule_ride);
			$schedule_ride->save();

			$status_message = __('messages.api.schedule_ride_updated');
		}
		else {
			$trip_path = $request->polyline ?? '';
			$peak_id= 0;

			if(isset($request->peak_id)) {
				$peak_id = $request->peak_id;
			}

			$schedule_ride = new ScheduleRide;
			$schedule_ride->user_id = $rider_id;
			$schedule_ride->schedule_date = date('Y-m-d', strtotime($request->schedule_date));
			$schedule_ride->schedule_time = $request->schedule_time;
			$schedule_ride->pickup_latitude = $request->pickup_latitude;
			$schedule_ride->pickup_longitude = $request->pickup_longitude;
			$schedule_ride->drop_latitude = $request->drop_latitude;
			$schedule_ride->drop_longitude = $request->drop_longitude;
			$schedule_ride->car_id = $request->car_id;
			$schedule_ride->pickup_location = $request->pickup_location;
			$schedule_ride->drop_location = urldecode($request->drop_location);
			$schedule_ride->status = 'Pending';
			$schedule_ride->trip_path = $trip_path;
			$schedule_ride->timezone = $request->timezone;
			$schedule_ride->payment_method =$request->payment_method;
			$schedule_ride->is_wallet = $request->is_wallet;
			$schedule_ride->location_id = $request->location_id;
			$schedule_ride->peak_id = $peak_id;
			$schedule_ride->save();

			$schedule_ride->fare_estimation = ScheduleRide::getFareEstimation($schedule_ride);
			$schedule_ride->save();

			$status_message = __('messages.api.schedule_ride_created');
		}

		$schedule_rides = ScheduleRide::where('user_id', $rider_id)->where('status','Pending')->orderBy('id','DESC')->limit(10)->get();

		return response()->json(compact('status_code','status_message','schedule_rides'));
	}

	/**
	 * Cancel Saved Schedule Ride
	 * @param  Get method request inputs
	 * @return Response Json
	 */
	public function schedule_ride_cancel(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();
		$rules = array(
			'trip_id' => 'required',
			'cancel_reason_id' => 'required',
		);

		$messages = array(
			'trip_id.required' => trans('messages.required.trip_id') . ' ' . trans('messages.field_is_required') . '',
			'cancel_reason_id.required' => trans('messages.required.cancel_reason_id') . ' ' . trans('messages.field_is_required') . '',
		);

		$cancelled_by = 'Driver';
		if ($user_details->user_type == 'Rider') {
			$cancelled_by = 'Rider';
		}

		$validator = Validator::make($request->all(), $rules, $messages);

		$validator->after(function ($validator) use ($request,$cancelled_by){
			$cancel_reason_exists= CancelReason::active()->where('cancelled_by',$cancelled_by)->where('id',$request->cancel_reason_id)->first();
	        if (!$cancel_reason_exists) {
	            $validator->errors()->add('cancel_reason_id', 'Id not exists');
	        }
	    });

	   	if ($validator->fails()) {
			return response()->json([
                'status_code'     => '0',
                'status_message' => $validator->messages()->first(),
            ]);
		}

		$rider_id = $user_details->id;
		$request_table = ScheduleRide::find($request->trip_id);
		$request_table->status = 'Cancelled';
		$request_table->save();

		$data = [
			'schedule_ride_id' => $request->trip_id,
			'cancel_reason' => @$request->cancel_comments != '' ? $request->cancel_comments : '',
			'cancel_by' => $cancelled_by,
			'cancel_reason_id' => $request->cancel_reason_id,
		];
		
		ScheduleCancel::updateOrCreate(['schedule_ride_id' => $request->trip_id], $data);

		//Send Sms
		$trips = ScheduleRide::where('id', $request->trip_id)->first();
		$m_number = $trips->users->phone_number;
		$message = 'Your Schedule Ride had been Cancelled.';
		$sms_gateway = resolve("App\Contracts\SMSInterface");
        $sms_gateway->send($m_number,$message);

		return ['status_code' => '1', 'status_message' => trans('messages.success')];
	}
	
	//Get Banners
	
	public function get_banners(Request $request) {

		
		$user_type = (strtolower($request->user_type) != 'rider') ? 1:0;
		

		$banners = Banner::active()->get()->map(function($value){
			return [
				'id'	=> $value->id,
				'title'	=> $value->title,
				'imageurl'	=> $value->url ?? '',
			
			];
		});
	
		return array(
			'status_code'		=> '1',
			'status_message' 	=> 'Success',
			'banners'			=> $banners ?? array(),
		    );
			
	}

	public function check_version(Request $request) {

		
		$referral_settings = resolve('referral_settings');
		$referral_settings = $referral_settings->where('user_type',ucfirst($request->user_type))->where('name','apply_referral')->first();
		
		$app_version_condition = ['no_update','force_update','skip_update'];
		$index = 0;
		$user_type = (strtolower($request->user_type) != 'rider') ? 1:0;
		
		$latest_verion = '';
		$get_latest_verion = DB::table('app_version')->select('force_update')->whereRaw('version > (select version from `app_version` where `device_type` = "'.$request->device_type.'" and `user_type` = "'.$user_type.'" and `version` = "'.$request->version.'")')->where('device_type',$request->device_type)->where('user_type',$user_type)->get();
		if($get_latest_verion->count()){
			$force_update_count = $get_latest_verion->where('force_update',1)->count();
			if($force_update_count)
				$index = 1;
			else
				$index = 2;
		}	
		$force_update 	   = $app_version_condition[$index];

		$social_logins = explode(',',site_settings('social_logins'));

		$support = Support::active()->get()->map(function($value){
			return [
				'id'	=> $value->id,
				'name'	=> $value->name,
				'link'	=> $value->link ?? '',
				'image'=> $value->image_src ?? '',
			];
		});
		$support2 = SupportDriver::active()->get()->map(function($value){
			return [
				'id'	=> $value->id,
				'name'	=> $value->name,
				'link'	=> $value->link ?? '',
				'image'=> $value->image_src ?? '',
			];
		});
		
			if($user_type = (strtolower($request->user_type) == 'rider'))
			{
				return array(
			'status_code'		=> '1',
			'status_message' 	=> 'Success',
			'force_update'		=> $force_update,
			'enable_referral' 	=> true,
			'client_id'			=> api_credentials('service_id','Apple'),
			"apple_login" 		=> in_array('apple',$social_logins),
			'facebook_login' 	=> in_array('facebook',$social_logins),
			'google_login' 		=> in_array('google',$social_logins),
		    'otp_enabled' 		=> site_settings('otp_verification')=='1' ? true:false,
			'support'			=> $support ?? array(),
		    );
			}
			else
			{
				return array(
			'status_code'		=> '1',
			'status_message' 	=> 'Success',
			'force_update'		=> $force_update,
			'enable_referral' 	=> true,
			'otp_enabled' 		=> site_settings('otp_verification')=='1' ? true:false,
			'support'			=> $support2 ?? array(),
		    );
			}

		// return array(
		// 	'status_code'		=> '1',
		// 	'status_message' 	=> 'Success',
		// 	'force_update'		=> $force_update,
		// 	'enable_referral' 	=> true,
		// 	'client_id'			=> api_credentials('service_id','Apple'),
		// 	"apple_login" 		=> in_array('apple',$social_logins),
		// 	'facebook_login' 	=> in_array('facebook',$social_logins),
		// 	'google_login' 		=> in_array('google',$social_logins),
		//     'otp_enabled' 		=> site_settings('otp_verification')=='1' ? true:false,
		// 	'support'			=> $support ?? array(),
		// );
	}

	/**
	 * Get Nearest Vehicles
	 * @param  Get method request inputs
	 *
	 * @return Response Json
	 */
	public function get_nearest_vehicles(Request $request)
	{
		$user_details = JWTAuth::parseToken()->authenticate();

		$rules = array(
			'latitude' 	=> 'required',
			'longitude' => 'required',
		);

		$validator = Validator::make($request->all(), $rules);

		if($validator->fails()) {
            return response()->json([
            	'status_code' => '0',
            	'status_message' => $validator->messages()->first()
            ]);
        }

        // Find nearest cars in location
		$nearest_car = DriverLocation::select(
			DB::raw('*, ( 3959 * acos( cos( radians('.$request->latitude.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$request->longitude.') ) + sin( radians('.$request->latitude.') ) * sin( radians( latitude ) ) ) ) as distance')
		)
		->with('car_type', 'users')
		->where(function($q) {
			$q->where('driver_location.status', 'Online')
			->orWhere('driver_location.status', 'Pool Trip');
		})
		->whereHas('users', function($query) {
			$query->activeOnlyStrict();
		})
		->whereHas('car_type', function($q) {
			$q->where('status', 'Active')
			->whereRaw(('case WHEN driver_location.status="Pool Trip" THEN car_type.is_pool="Yes" ELSE 1 END'));
		})
		->havingRaw(('case WHEN status="Online" THEN distance<='.site_settings('driver_km').' ELSE distance<='.site_settings('pickup_km').' END'))
		->orderBy('distance', 'ASC')
		->get();

		$data = $nearest_car->map(function($car) {
			return [
				// 'distance' => $car->distance,
				'driver_id' => $car->user_id,
				'vehicle_id' => $car->car_id,
				'vehicle_type' => $car->car_type->car_name,
				'latitude' 	=> $car->latitude,
				'longitude' => $car->longitude,
				'is_pool' => $car->car_type->is_pool=='Yes',
			];
		});

		return array(
			'status_code'	=> '1',
			'status_message' => __('messages.api.listed_successfully'),
			'data'	=> $data,
		);
	}
}
