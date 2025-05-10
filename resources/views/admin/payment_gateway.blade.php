@extends('admin.template')
@section('main')
<style type="text/css">
	.tooltip-custom {
		display: inline-block;
		position: relative;
		vertical-align: middle;
		line-height: 16px;
		margin: -5px 0 -3px;
		padding: 4px 0;
	}
	.tooltip-custom .icon {
		background: url("../images/seller_settings.png") no-repeat;
		background-size: 120px 200px;
	}
	.tooltip-custom .icon {
		display: block;
		width: 14px;
		height: 14px;
		background-position: -95px -150px !important;
		opacity: 0.4;
	}
	.tooltip-custom em {
		font-weight: normal;
		font-size: 12px;
		padding: 2px 10px 10px;
		width: 200px;
		white-space: normal;
		line-height: 16px;
		top: 22px;
		text-align: left;
		margin-left: -100px !important;
		left: 50%;
		background: #2c3239;
		border-radius: 2px;
		color: #fff;
		font-style: normal;
		position: absolute;
		display: none;
		z-index: 1;
	}
	.tooltip-custom em::after{
		-moz-border-bottom-colors: none;
		-moz-border-left-colors: none;
		-moz-border-right-colors: none;
		-moz-border-top-colors: none;
		border-color: #2c3239 transparent transparent;
		border-image: none;
		border-style: solid;
		border-width: 3px;
		top: -6px;
		content: "";
		left: 50%;
		margin-left: -3px;
		position: absolute;
		transform: rotate(180deg);
	}
	.tooltip-custom:hover em {
		display: block !important;
	}
	.box-body
	{
		padding: 0;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1> Payment Gateway </h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"> <i class="fa fa-dashboard"></i> Home </a>
			</li>
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/payment_gateway') }}"> Payment Gateway </a>
			</li>
			<li class="active"> Edit </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"> Payment Gateway Form </h3>
					</div>
					<form action="{{ url('admin/payment_gateway') }}" method="POST" class="form-horizontal">
                     @csrf
					<div class="box-body">
						<span class="text-danger">(*)Fields are Mandatory</span>
                 
						<!-- Paypal Section Start -->
						<div class="box-body">
							<div class="form-group" ng-init="paypal_enabled={{ old('paypal_enabled',payment_gateway('is_enabled','Paypal')) }}">
								<label for="input_paypal_enabled" class="col-sm-3 control-label">Is Paypal Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paypal_enabled" class="form-control" id="input_paypal_enabled" ng-model="paypal_enabled">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                                </select>
									<span class="text-danger">{{ $errors->first('paypal_enabled') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paypal_mode" class="col-sm-3 control-label">PayPal Mode <em ng-show="paypal_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paypal_mode" class="form-control" id="input_paypal_mode">
                                  <option value="sandbox"{{ old('paypal_mode', payment_gateway('mode', 'Paypal')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                                 <option value="live"{{ old('paypal_mode', payment_gateway('mode', 'Paypal')) === 'live' ? ' selected' : '' }}>Live</option>
                              </select>
									<span class="text-danger">{{ $errors->first('paypal_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paypal_id" class="col-sm-3 control-label">PayPal Id <em ng-show="paypal_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paypal_id" value="{{ old('paypal_id', payment_gateway('paypal_id', 'Paypal')) }}" class="form-control" id="input_paypal_id" placeholder="PayPal Id">
									<span class="text-danger">{{ $errors->first('paypal_id') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paypal_client" class="col-sm-3 control-label">PayPal Client ID <em ng-show="paypal_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paypal_client" value="{{ old('paypal_client', payment_gateway('client', 'Paypal')) }}" class="form-control" id="" placeholder="PayPal Client">
									<span class="text-danger">{{ $errors->first('paypal_client') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paypal_secret" class="col-sm-3 control-label"> PayPal Secret <em ng-show="paypal_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paypal_secret" value="{{ old('paypal_secret', payment_gateway('secret', 'Paypal')) }}" class="form-control" id="" placeholder="PayPal Secret">
									<span class="text-danger">{{ $errors->first('paypal_secret') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="accessToken" class="col-sm-3 control-label"> PayPal Access Token <em ng-show="paypal_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paypal_access_token" value="{{ old('paypal_access_token', payment_gateway('access_token', 'Paypal')) }}" class="form-control" id="accessToken" placeholder="PayPal Access Token">
									<span class="text-danger">{{ $errors->first('paypal_access_token') }}</span>
								</div>
							</div>
						</div>
						<!-- Paypal Section End -->
						<!-- Stripe Section Start -->
						<div class="box-body" ng-init="stripe_enabled={{ old('stripe_enabled',payment_gateway('is_enabled','Stripe')) }}">
							<div class="form-group">
								<label for="input_stripe_enabled" class="col-sm-3 control-label">Is Stripe Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="stripe_enabled" class="form-control" id="input_stripe_enabled" ng-model="stripe_enabled">
                                <option value="0"{{ old('stripe_enabled', payment_gateway('is_enabled', 'Stripe')) === '0' ? ' selected' : '' }}>No</option>
                                <option value="1"{{ old('stripe_enabled', payment_gateway('is_enabled', 'Stripe')) === '1' ? ' selected' : '' }}>Yes</option>
                                </select>
									<span class="text-danger">{{ $errors->first('stripe_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_publish_key" class="col-sm-3 control-label"> Stripe Key <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="stripe_publish_key" value="{{ old('stripe_publish_key', payment_gateway('publish', 'Stripe')) }}" class="form-control" id="input_stripe_publish_key" placeholder="Stripe Key">
									<span class="text-danger">{{ $errors->first('stripe_publish_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_secret_key" class="col-sm-3 control-label"> Stripe Secret <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="stripe_secret_key" value="{{ old('stripe_secret_key', payment_gateway('secret', 'Stripe')) }}" class="form-control" id="input_stripe_secret_key" placeholder="Stripe Secret">
									<span class="text-danger">{{ $errors->first('stripe_secret_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_api_version" class="col-sm-3 control-label"> Stripe API Version <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="stripe_api_version" value="{{ old('stripe_api_version', payment_gateway('api_version', 'Stripe')) }}" class="form-control" id="input_stripe_api_version" placeholder="Stripe API Version">
									<span class="text-danger">{{ $errors->first('stripe_api_version') }}</span>
								</div>
							</div>
						</div>
					</div>
					<!-- Stripe Section End -->
					  <!-- Paytm Section Start -->
                  <div class="box-body" ng-init="paytm_enabled={{ old('paytm_enabled',payment_gateway('is_enabled','Paytm')) }}">
							<div class="form-group">
								<label for="input_paytm_enabled" class="col-sm-3 control-label">Is Paytm Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paytm_enabled" class="form-control" id="input_paytm_enabled" ng-model="paytm_enabled">
                                <option value="0"{{ old('paytm_enabled', payment_gateway('is_enabled', 'Paytm')) === '0' ? ' selected' : '' }}>No</option>
                                <option value="1"{{ old('paytm_enabled', payment_gateway('is_enabled', 'Paytm')) === '1' ? ' selected' : '' }}>Yes</option>
                                </select>
									<span class="text-danger">{{ $errors->first('paytm_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_mode" class="col-sm-3 control-label">Paytm Mode <em ng-show="paytm_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paytm_mode" class="form-control" id="input_paytm_mode">
                                <option value="sandbox"{{ old('paytm_mode', payment_gateway('mode', 'Paytm')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                                <option value="live"{{ old('paytm_mode', payment_gateway('mode', 'Paytm')) === 'live' ? ' selected' : '' }}>Live</option>
                              </select>
									<span class="text-danger">{{ $errors->first('paytm_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paytm_merchant" class="col-sm-3 control-label"> Paytm Merchant <em ng-show="paytm_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paytm_merchant" value="{{ old('paytm_merchant', payment_gateway('paytm_merchant', 'Paytm')) }}" class="form-control" id="input_paytm_merchant" placeholder="Paytm">
									<span class="text-danger">{{ $errors->first('paytm_merchant') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_secret" class="col-sm-3 control-label"> Paytm Secret <em ng-show="paytm_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paytm_secret" value="{{ old('paytm_secret', payment_gateway('paytm_secret', 'Paytm')) }}" class="form-control" id="input_paytm_secret" placeholder="Paytm Secret">
									<span class="text-danger">{{ $errors->first('paytm_secret') }}</span>
								</div>
							</div>
					</div>
					<!-- Paytm Section End -->
					
					 <!-- Razorpay Section Start -->
                  <div class="box-body" ng-init="razorpay_enabled={{ old('razorpay_enabled',payment_gateway('is_enabled','Razorpay')) }}">
							<div class="form-group">
								<label for="input_razorpay_enabled" class="col-sm-3 control-label">Is Razorpay Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="razorpay_enabled" class="form-control" id="input_razorpay_enabled" ng-model="razorpay_enabled">
                                <option value="0"{{ old('razorpay_enabled', payment_gateway('is_enabled', 'Razorpay')) === '0' ? ' selected' : '' }}>No</option>
                                <option value="1"{{ old('razorpay_enabled', payment_gateway('is_enabled', 'Razorpay')) === '1' ? ' selected' : '' }}>Yes</option>
                                </select>
									<span class="text-danger">{{ $errors->first('razorpay_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_razorpay_mode" class="col-sm-3 control-label">Razorpay Mode <em ng-show="razorpay_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="razorpay_mode" class="form-control" id="input_razorpay_mode">
                               <option value="sandbox"{{ old('razorpay_mode', payment_gateway('mode', 'Razorpay')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                               <option value="live"{{ old('razorpay_mode', payment_gateway('mode', 'Razorpay')) === 'live' ? ' selected' : '' }}>Live</option>
                               </select>
									<span class="text-danger">{{ $errors->first('razorpay_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_razorpay_key_id" class="col-sm-3 control-label"> Razorpay Key ID <em ng-show="razorpay_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="razorpay_key_id" value="{{ old('razorpay_key_id', payment_gateway('key_id', 'Razorpay')) }}" class="form-control" id="input_razorpay_merchant" placeholder="Razorpay Key ID">
									<span class="text-danger">{{ $errors->first('razorpay_key_id') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_razorpay_key_secret" class="col-sm-3 control-label"> Razorpay Key Secret <em ng-show="razorpay_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="razorpay_key_secret" value="{{ old('razorpay_key_secret', payment_gateway('key_secret', 'Razorpay')) }}" class="form-control" id="input_razorpay_secret" placeholder="Razorpay Key Secret">
									<span class="text-danger">{{ $errors->first('razorpay_key_secret') }}</span>
								</div>
							</div>
					</div>
					<!-- Razorpay Section End -->
					 <!-- FlutterWave Section Start -->
                  <div class="box-body" ng-init="flutterwave_enabled={{ old('flutterwave_enabled',payment_gateway('is_enabled','Flutterwave')) }}">
							<div class="form-group">
								<label for="input_flutterwave_enabled" class="col-sm-3 control-label">Is Flutterwave Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="flutterwave_enabled" class="form-control" id="input_flutterwave_enabled" ng-model="flutterwave_enabled">
                        <option value="0"{{ old('flutterwave_enabled', payment_gateway('is_enabled', 'Flutterwave')) === '0' ? ' selected' : '' }}>No</option>
                        <option value="1"{{ old('flutterwave_enabled', payment_gateway('is_enabled', 'Flutterwave')) === '1' ? ' selected' : '' }}>Yes</option>
                        </select>
									<span class="text-danger">{{ $errors->first('paytm_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_mode" class="col-sm-3 control-label">Flutterwave Mode <em ng-show="flutterwave_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="flutterwave_mode" class="form-control" id="input_flutterwave_mode">
                                 <option value="sandbox"{{ old('flutterwave_mode', payment_gateway('mode', 'Flutterwave')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                                 <option value="live"{{ old('flutterwave_mode', payment_gateway('mode', 'Flutterwave')) === 'live' ? ' selected' : '' }}>Live</option>
                                </select>
									<span class="text-danger">{{ $errors->first('flutterwave_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paytm_merchant" class="col-sm-3 control-label"> Flutterwave Public Key <em ng-show="flutterwave_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="flutterwave_public_key" value="{{ old('flutterwave_public_key', payment_gateway('public_key', 'Flutterwave')) }}" class="form-control" id="input_flutterwave_public_key" placeholder="Flutterwave">
									<span class="text-danger">{{ $errors->first('flutterwave_public_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_secret" class="col-sm-3 control-label"> Flutterwave Secret Key <em ng-show="flutterwave_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="flutterwave_secret_key" value="{{ old('flutterwave_secret_key', payment_gateway('secret_key', 'Flutterwave')) }}" class="form-control" id="input_flutterwave_secret" placeholder="Flutterwave Secret">
									<span class="text-danger">{{ $errors->first('flutterwave_secret_key') }}</span>
								</div>
							</div>
							
								<div class="form-group">
								<label for="input_paytm_secret" class="col-sm-3 control-label"> Flutterwave Encryption key <em ng-show="flutterwave_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="flutterwave_encryption_key" value="{{ old('flutterwave_encryption_key', payment_gateway('encryption_key', 'Flutterwave')) }}" class="form-control" id="input_flutterwave_encryption" placeholder="Flutterwave Encryption Key">
									<span class="text-danger">{{ $errors->first('flutterwave_encryption_key') }}</span>
								</div>
							</div>
					</div>
					<!-- FlutterWave Section End -->
					
							<!-- Mpesa Section Start -->
						<div class="box-body" ng-init="mpesa_enabled={{ old('mpesa_enabled',payment_gateway('is_enabled','Mpesa')) }}">
							<div class="form-group">
								<label for="input_stripe_enabled" class="col-sm-3 control-label">Is Mpesa Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="mpesa_enabled" class="form-control" id="input_mpesa_enabled" ng-model="mpesa_enabled">
                            <option value="0"{{ old('mpesa_enabled', payment_gateway('is_enabled', 'Mpesa')) === '0' ? ' selected' : '' }}>No</option>
                            <option value="1"{{ old('mpesa_enabled', payment_gateway('is_enabled', 'Mpesa')) === '1' ? ' selected' : '' }}>Yes</option>
                            </select>
									<span class="text-danger">{{ $errors->first('mpesa_enabled') }}</span>
								</div>
							</div>
								<div class="form-group">
								<label for="input_paypal_mode" class="col-sm-3 control-label">Mpesa Mode <em ng-show="paypal_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="mpesa_mode" class="form-control" id="input_mpesa_mode">
                               <option value="sandbox"{{ old('mpesa_mode', payment_gateway('mode', 'Mpesa')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                               <option value="live"{{ old('mpesa_mode', payment_gateway('mode', 'Mpesa')) === 'live' ? ' selected' : '' }}>Live</option>
                               </select>
									<span class="text-danger">{{ $errors->first('mpesa_mode') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_publish_key" class="col-sm-3 control-label"> Consumer Key <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="mpesa_mode" class="form-control" id="input_mpesa_mode">
                               <option value="sandbox"{{ old('mpesa_mode', payment_gateway('mode', 'Mpesa')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                              <option value="live"{{ old('mpesa_mode', payment_gateway('mode', 'Mpesa')) === 'live' ? ' selected' : '' }}>Live</option>
                            </select>
									<span class="text-danger">{{ $errors->first('consumer_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_secret_key" class="col-sm-3 control-label"> Consumer Secret <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="consumer_secret" value="{{ old('consumer_secret', payment_gateway('consumer_secret', 'Mpesa')) }}" class="form-control" id="input_consumer_secret" placeholder="Consumer Secret">
									<span class="text-danger">{{ $errors->first('consumer_secret') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_stripe_api_version" class="col-sm-3 control-label"> Callback Url <em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="callback_url" value="{{ old('callback_url', payment_gateway('callback_url', 'Mpesa')) }}" class="form-control" id="input_callback_url" placeholder="Callback Url">
									<span class="text-danger">{{ $errors->first('callback_url') }}</span>
								</div>
							</div>
								<div class="form-group">
								<label for="input_stripe_api_version" class="col-sm-3 control-label"> Business Shortcode<em ng-show="stripe_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="business_shortcode" value="{{ old('business_shortcode', payment_gateway('business_shortcode', 'Mpesa')) }}" class="form-control" id="input_business_shortcode" placeholder="Business Shortcode">
									<span class="text-danger">{{ $errors->first('business_shortcode') }}</span>
								</div>
							</div>
						</div>
					
					<!-- Mpesa Section End -->
					
					 <!-- Mollie Section Start--->
                  <div class="box-body" ng-init="mollie_enabled={{ old('mollie_enabled',payment_gateway('is_enabled','Mollie')) }}">
							<div class="form-group">
								<label for="input_paytm_enabled" class="col-sm-3 control-label">Is Mollie Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="mollie_enabled" class="form-control" id="input_mollie_enabled" ng-model="mollie_enabled">
                               <option value="0"{{ old('mollie_enabled', payment_gateway('is_enabled', 'Mollie')) === '0' ? ' selected' : '' }}>No</option>
                               <option value="1"{{ old('mollie_enabled', payment_gateway('is_enabled', 'Mollie')) === '1' ? ' selected' : '' }}>Yes</option>
                               </select>
									<span class="text-danger">{{ $errors->first('mollie_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_mode" class="col-sm-3 control-label">Mollie Mode <em ng-show="mollie_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="mollie_mode" class="form-control" id="input_mollie_mode">
                              <option value="sandbox"{{ old('mollie_mode', payment_gateway('mode', 'Mollie')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                              <option value="live"{{ old('mollie_mode', payment_gateway('mode', 'Mollie')) === 'live' ? ' selected' : '' }}>Live</option>
                              </select>
									<span class="text-danger">{{ $errors->first('mollie_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paytm_merchant" class="col-sm-3 control-label"> Mollie Api Key <em ng-show="mollie_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="mollie_key" value="{{ old('mollie_key', payment_gateway('api_key', 'Mollie')) }}" class="form-control" id="input_mollie_merchant" placeholder="Mollie Api Key">
									<span class="text-danger">{{ $errors->first('mollie_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paytm_secret" class="col-sm-3 control-label"> Mollie Callback <em ng-show="mollie_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="mollie_callback" value="{{ old('mollie_callback', payment_gateway('callback_url', 'Mollie')) }}" class="form-control" id="input_mollie_callback" placeholder="Callback Url">
									<span class="text-danger">{{ $errors->first('mollie_callback') }}</span>
								</div>
							</div>
							
							<div class="form-group">
								<label for="input_paytm_secret" class="col-sm-3 control-label"> Mollie Webhook <em ng-show="mollie_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="mollie_webhook" value="{{ old('mollie_webhook', payment_gateway('webhook_url', 'Mollie')) }}" class="form-control" id="input_mollie_webhook" placeholder="Webhook Url">
									<span class="text-danger">{{ $errors->first('mollie_webhook') }}</span>
								</div>
							</div>
							
					</div>
					<!-- Mollie Section End -->
					
					 <!-- Paystack Section Start--->
                  <div class="box-body" ng-init="paystack_enabled={{ old('paystack_enabled',payment_gateway('is_enabled','Paystack')) }}">
							<div class="form-group">
								<label for="input_paystack_enabled" class="col-sm-3 control-label">Is Paystack Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paystack_enabled" class="form-control" id="input_paystack_enabled" ng-model="paystack_enabled">
                                 <option value="0"{{ old('paystack_enabled', payment_gateway('is_enabled', 'Paystack')) === '0' ? ' selected' : '' }}>No</option>
                                 <option value="1"{{ old('paystack_enabled', payment_gateway('is_enabled', 'Paystack')) === '1' ? ' selected' : '' }}>Yes</option>
                                </select>
									<span class="text-danger">{{ $errors->first('paystack_enabled') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paystack_mode" class="col-sm-3 control-label">Paystack Mode <em ng-show="paystack_enabled == '1'" class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="paystack_mode" class="form-control" id="input_paystack_mode">
                              <option value="sandbox"{{ old('paystack_mode', payment_gateway('mode', 'Paystack')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                              <option value="live"{{ old('paystack_mode', payment_gateway('mode', 'Paystack')) === 'live' ? ' selected' : '' }}>Live</option>
                             </select>
									<span class="text-danger">{{ $errors->first('paystack_mode') }}</span>
								</div>
							</div>

							<div class="form-group">
								<label for="input_paystack_public_key" class="col-sm-3 control-label"> Paystack Public Key <em ng-show="paystack_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paystack_public_key" value="{{ old('paystack_public_key', payment_gateway('public_key', 'Paystack')) }}" class="form-control" id="input_public_merchant" placeholder="Paystack Public Key">
									<span class="text-danger">{{ $errors->first('public_key') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_paystack_secret" class="col-sm-3 control-label"> Paystack Callback Url <em ng-show="paystack_enabled == '1'" class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="paystack_callback_url" value="{{ old('paystack_callback_url', payment_gateway('callback_url', 'Paystack')) }}" class="form-control" id="input_paystack_callback_url" placeholder="Paystack Callback Url">
									<span class="text-danger">{{ $errors->first('paystack_callback_url') }}</span>
								</div>
							</div>
							
						
							
					</div>
					<!-- Mollie Section End -->
					
					<!-- Braintree Section Start -->
					<div class="box-body" ng-init="bt_enabled={{ old('bt_enabled',payment_gateway('is_enabled','Braintree')) }}">
						<div class="form-group">
								<label for="input_bt_enabled" class="col-sm-3 control-label">Is Braintree Enabled <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									<select name="bt_enabled" class="form-control" id="input_bt_enabled" ng-model="bt_enabled">
                              <option value="0"{{ old('bt_enabled', payment_gateway('is_enabled', 'Braintree')) === '0' ? ' selected' : '' }}>No</option>
                              <option value="1"{{ old('bt_enabled', payment_gateway('is_enabled', 'Braintree')) === '1' ? ' selected' : '' }}>Yes</option>
                            </select>
									<span class="text-danger">{{ $errors->first('bt_enabled') }}</span>
								</div>
							</div>
						<div class="form-group">
							<label for="input_mode" class="col-sm-3 control-label"> Payment Mode <em ng-show="bt_enabled == '1'" class="text-danger">*</em> </label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="bt_mode" class="form-control" id="input_mode">
                            <option value="sandbox"{{ old('bt_mode', payment_gateway('mode', 'Braintree')) === 'sandbox' ? ' selected' : '' }}>Sandbox</option>
                            <option value="production"{{ old('bt_mode', payment_gateway('mode', 'Braintree')) === 'production' ? ' selected' : '' }}>Production</option>
                           </select>
								<span class="text-danger">{{ $errors->first('mode') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_merchant_id" class="col-sm-3 control-label"> Braintree Merchant ID <em ng-show="bt_enabled == '1'" class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="bt_merchant_id" value="{{ old('bt_merchant_id', payment_gateway('merchant_id', 'Braintree')) }}" class="form-control" id="input_merchant_id" placeholder="Merchant ID">
								<span class="text-danger">{{ $errors->first('bt_merchant_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_merchant_id" class="col-sm-3 control-label">
								Braintree Merchant Account ID
								<span class="tooltip-custom"><i class="icon"></i> 
									<em style="margin-left: -108px;">
										Merchant account ID is a unique identifier for a specific merchant account in your gateway, and is used to specify which merchant account to use when creating a transaction.
									</em>
								</span>
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="merchant_account_id" value="{{ old('merchant_account_id', payment_gateway('merchant_account_id', 'Braintree')) }}" class="form-control" id="input_merchant_account_id" placeholder="Braintree Merchant Account Id">
								<small class="description" style="color: #9da1ab;">
					                For default account id, leave it as empty.
					            </small>
							</div>
						</div>

						<div class="form-group">
							<label for="input_bt_public" class="col-sm-3 control-label"> Braintree Public Key <em ng-show="bt_enabled == '1'" class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="bt_public_key" value="{{ old('bt_public_key', payment_gateway('public_key', 'Braintree')) }}" class="form-control" id="input_bt_public" placeholder="Public Key">
								<span class="text-danger">{{ $errors->first('bt_public_key') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_bt_private_key" class="col-sm-3 control-label"> Braintree Private Key <em ng-show="bt_enabled == '1'" class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="bt_private_key" value="{{ old('bt_private_key', payment_gateway('private_key', 'Braintree')) }}" class="form-control" id="input_bt_private_key" placeholder="Private Key">
								<span class="text-danger">{{ $errors->first('bt_private_key') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_tokenization_key" class="col-sm-3 control-label">
								Braintree Tokenization Key
								<span class="tooltip-custom"><i class="icon"></i> 
									<em style="margin-left: -108px;">
										Manage the ways you authorize requests to Braintree for client requests
									</em>
								</span>
								<em class="text-danger">*</em>
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="tokenization_key" value="{{ old('tokenization_key', payment_gateway('tokenization_key', 'Braintree')) }}" class="form-control" id="input_tokenization_key" placeholder="Braintree Tokenization Key">
								<span class="text-danger">{{ $errors->first('tokenization_key') }}</span>
							</div>
						</div>
					</div>
					<!-- Braintree Section End -->

					<div class="form-group">
							<label for="is_web_payment" class="col-sm-3 control-label"> Web payment <em ng-show="bt_enabled == '1'" class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="checkbox" name="is_web_payment" id="is_web_payment" value="1" {{old('is_web_payment',payment_gateway('is_web_payment','Common')) ==1 ? 'checked':''}} > 
							</div>
						</div>

					<!-- Payout Methods Section Start -->
						<div class="box-body">
							<div class="form-group">
								<label for="input_payout_methods" class="col-sm-3 control-label"> Payout Methods <em class="text-danger">*</em> </label>
								<div class="col-md-7 col-sm-offset-1">
									@foreach(PAYOUT_METHODS as $payout_method)
									<div ng-init="payout_method_{{ $payout_method['key'] }}={{ isPayoutEnabled($payout_method['key']) }}">
										<input type="checkbox" name="payout_methods[]" id="payout_method-{{ $payout_method['key'] }}" value="{{ $payout_method['key'] }}" ng-checked="{{ isPayoutEnabled($payout_method['key']) }}"> <label for="payout_method-{{ $payout_method['key'] }}" ng-model="payout_method_{{ $payout_method['key'] }}"> {{ $payout_method["value"] }} </label>
									</div>										
									@endforeach
								</div>
							</div>
					</div>
					<!-- Payout Methods Section End -->
					
					<div class="box-footer text-center">
						<button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
						<button type="reset" class="btn btn-default"> Cancel </button>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</section>
</div>
@endsection