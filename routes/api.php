<?php

/*
|--------------------------------------------------------------------------
| API Rutas
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas de API para tu aplicación. 
| Estas rutas las carga el RouteServiceProvider dentro de un grupo al que se le asigna el grupo de middleware "api".
|
*/

// cron request for schedule ride
Route::match(['post','get'],'web_payment', 'PaymentController@payment')->name('paypal.view');
// Flutter
//Route::match(['post','get'],'flutterwave_web_payment', 'FlutterwaveController@flutterwave');
//Route::match(['post','get'],'flutterwave_payment', 'FlutterwaveController@flutterwave_payment')->name('payment.flutterwave');
//Route::match(['post','get'],'flutterwave_callback', 'FlutterwaveController@futterwave_callback');
// Mpesa
Route::match(['post','get'],'mpesa_web_payment', 'MpesaController@mpesa');
Route::match(['post','get'],'mpesa_payment', 'MpesaController@customerMpesaSTKPush')->name('payment.mpesa');
Route::match(['post','get'],'mpesa_callback', 'MpesaController@mpesaConfirmation');
//Route::match(['post','get'],'flutterwave_callback', 'PaymentController@futterwave_callback');
// PayTm
Route::match(['post','get'],'paytm_web_payment', 'PaytmController@paytm_payment')->name('paytm.view');
Route::match(['post','get'],'paytm_callback', 'PaytmController@paytm_callback');

//Mollie
Route::match(['post','get'],'mollie_web_payment', 'MollieController@mollie');
Route::match(['post','get'],'mollie_webhook', 'MollieController@webhook');
Route::match(['post','get'],'mollie_callback', 'MollieController@mollie_callback')->name('mollie.callback');

//RazorPay Start
Route::match(['post','get'],'razorpay_web_payment', 'RazorpayController@razorpay');
Route::match(['post','get'],'razorpay_payment', 'RazorpayController@razorpay_payment')->name('payment.razorpay');
Route::match(['post','get'],'razorpay_callback', 'RazorpayController@razorpay_callback');
//Razorpay End

//Paystack Start
Route::match(['post','get'],'paystack_web_payment', 'PaystackController@paystack');
Route::match(['post','get'],'paystack_payment', 'PaystackController@paystack_payment')->name('payment.paystack');
Route::match(['post','get'],'paystack_callback', 'PaystackController@paystack_callback');
//Paystack End

Route::post('payment/success', 'PaymentController@success')->name('payment.success');
Route::get('payment/cancel', 'PaymentController@cancel')->name('payment.cancel');
Route::get('cron_request_car', 'CronController@requestCars');
Route::get('cron_offline', 'CronController@updateOfflineUsers');
Route::get('currency_cron', 'CronController@updateCurrency');
Route::get('update_referral_cron', 'CronController@updateReferralStatus');
Route::match(['get', 'post'], 'paypal_payout', 'CronController@updatePaypalPayouts');

Route::get('check_version', 'RiderController@check_version');

// get banners

Route::get('get_banners', 'RiderController@get_banners');

//TokenAuthController
Route::get('register', 'TokenAuthController@register');
Route::get('socialsignup', 'TokenAuthController@socialsignup');
Route::match(array('GET', 'POST'),'apple_callback', 'TokenAuthController@apple_callback');

Route::get('login', 'TokenAuthController@login');
Route::get('otp_verification', 'TokenAuthController@otp_verification');
Route::get('numbervalidation', 'TokenAuthController@numbervalidation');
Route::get('emailvalidation', 'TokenAuthController@emailvalidation');
Route::get('forgotpassword', 'TokenAuthController@forgotpassword');

Route::get('language_list', 'TokenAuthController@language_list');
Route::get('currency_list', 'TokenAuthController@currency_list');

// With Login Routes
Route::group(['middleware' => 'jwt.verify'], function () {
	\Log::error('route start');

	Route::match(array('GET', 'POST'),'common_data','HomeController@commonData');
	Route::post('get_payment_list','HomeController@getPaymentList');

	Route::get('logout', 'TokenAuthController@logout');
	
	Route::get('language','TokenAuthController@language');
	Route::get('update_device', 'TokenAuthController@updateDevice');
	Route::get('updatelocation', 'DriverController@updateLocation');
	Route::get('check_status', 'DriverController@checkStatus');

	// Common API for Both Driver & Rider
	Route::post('update_document','DriverController@update_document');
	Route::get('country_list', 'DriverController@country_list');
	Route::get('toll_reasons', 'TripController@toll_reasons');
	Route::get('cancel_reasons', 'TripController@cancel_reasons');
	Route::get('get_referral_details', 'ReferralsController@get_referral_details');
	Route::get('get_trip_details', 'TripController@get_trip_details');
	Route::get('send_message', 'TripController@send_message');

	// Rider Only APIs
	Route::get('get_nearest_vehicles', 'RiderController@get_nearest_vehicles');
	Route::get('search_cars', 'RiderController@searchCars');
	Route::post('request_cars', 'RiderController@requestCars');
	Route::get('track_driver', 'RiderController@track_driver');
	Route::get('updateriderlocation', 'RiderController@updateriderlocation');
	Route::get('promo_details','RiderController@promo_details');
	Route::get('sos','RiderController@sos');
	Route::get('sosalert','RiderController@sosalert');
	Route::post('save_schedule_ride', 'RiderController@save_schedule_ride');
	Route::get('schedule_ride_cancel', 'RiderController@schedule_ride_cancel');
	Route::post('add_wallet', 'AppPaymentController@appPaymentSuccess');
	Route::post('transfer_money', 'RiderController@transfer_money');
	Route::post('after_payment', 'AppPaymentController@appPaymentSuccess');
	Route::get('get_past_trips','TripController@get_past_trips');
	Route::get('get_upcoming_trips','TripController@get_upcoming_trips');
	Route::match(['GET', 'POST'],'currency_conversion', 'TokenAuthController@currency_conversion');

	// Driver Only APIs
	Route::get('get_pending_trips','TripController@get_pending_trips');
	Route::get('get_completed_trips','TripController@get_completed_trips');
	Route::match(array('GET', 'POST'), 'driver_create_ride','TripController@driver_create_ride');
	Route::get('arive_now', 'TripController@arriveNow');
	Route::get('begin_trip', 'TripController@beginTrip');
	Route::get('accept_request', 'TripController@acceptTrip');
	Route::get('cash_collected', 'DriverController@cash_collected');
	
	Route::match(array('GET', 'POST'), 'map_upload','TripController@map_upload');
	Route::match(array('GET', 'POST'), 'end_trip','TripController@end_trip');
	Route::match(array('GET', 'POST'), 'upload_profile_image','ProfileController@upload_profile_image');
	
	Route::get('heat_map', 'MapController@heat_map');
	Route::post('pay_to_admin', 'AppPaymentController@appPaymentSuccess');
	Route::post('pay_to_admin_wallet', 'AppPaymentController@appAdminPaymentSuccess');

	// TripController
	Route::get('cancel_trip', 'TripController@cancel_trip');
	
	// Earning Controller
	Route::get('earning_chart', 'EarningController@earning_chart');
	Route::get('add_promo_code', 'EarningController@add_promo_code');

	// Rating Controller
	Route::get('driver_rating', 'RatingController@driver_rating');
	Route::get('rider_feedback', 'RatingController@rider_feedback');
	Route::get('trip_rating', 'RatingController@trip_rating');
	Route::get('get_invoice', 'RatingController@getinvoice');

	//profile Controller
	Route::get('get_rider_profile', 'ProfileController@get_rider_profile');
	Route::get('update_rider_profile', 'ProfileController@update_rider_profile');
	Route::get('get_driver_profile', 'ProfileController@get_driver_profile');
	Route::get('update_driver_profile', 'ProfileController@update_driver_profile');
	Route::get('update_vehicle_details', 'ProfileController@updateVehicleDetails');
	Route::get('vehicle_details', 'ProfileController@vehicleDetails');
	Route::get('update_rider_location', 'ProfileController@update_rider_location');
	Route::get('update_user_currency', 'ProfileController@update_user_currency');
	Route::get('get_caller_detail', 'ProfileController@get_caller_detail');
	Route::get('vehicle_descriptions', 'ProfileController@vehicleDescriptions');

	Route::get('add_card_details', 'AppPaymentController@add_card_details');
	Route::get('get_card_details', 'AppPaymentController@get_card_details');

	// Manage Driver Payout Routes
	Route::get('stripe_supported_country_list', 'PayoutDetailController@stripeSupportedCountryList');
	Route::post('update_payout_preference','PayoutDetailController@updatePayoutPreference');
	Route::get('get_payout_list','PayoutDetailController@getPayoutPreference');
	Route::get('earning_list', 'PayoutDetailController@earningList');
	Route::get('weekly_trip', 'PayoutDetailController@weeklyTrip');
	Route::get('weekly_statement', 'PayoutDetailController@weeklyStatement');
	Route::get('daily_statement', 'PayoutDetailController@dailyStatement');
	Route::post('update_vehicle', 'DriverController@updateVehicle');
	Route::post('delete_vehicle','DriverController@deleteVehicle');
	Route::get('update_default_vehicle','DriverController@updateDefaultVehicle');
});
