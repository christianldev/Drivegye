<title>Profile</title>
@extends('template_dashboard')
@section('main')
<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 flexbox__item four-fifths page-content" style="padding:0px;" ng-controller="facebook_account_kit">
	<div class="separated--bottom  text--left" style="padding:0px 15px;">
		<h1 class="cls_profiletitle">{{trans('messages.header.profile')}}</h1>
	</div>
	<div style="padding:0px 15px;">
	 <form action="{{ url('rider_update_profile/'.$result->id) }}" method="POST" class="layout layout--flush" id="form" enctype="multipart/form-data" name="rider_profile">
     @csrf
  		@include('dashboard.mobile_number_change')
		<input type="hidden" name="user_type" value="{{ $result->user_type }}">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
		<input type="hidden" name="code" id="code" />
		<input type="hidden" id="user_id" name="user_id" value="{{ $result->id }}">
		<div class="parter-info separated--bottom" style="padding: 0px 0px 15px;">
			<h2 class="flush-h2">{{trans('messages.profile.general')}}</h2>
		</div>
		<div class="parter-info separated--bottom col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 25px 0px 15px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6 nam_pro" style="padding:0px;">
					{{trans('messages.profile.name')}} <em class="text-danger">*</em>
				</label>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 p-0">
					<input type="text" name="first_name" id="first_name" class="_style_3vhmZK" placeholder="{{ trans('messages.user.firstname') }}" value="{{ Auth::user()->first_name }}">
					<span class="text-danger"> {{ $errors->first('first_name') }} </span>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pr-0"> 
					<input type="text" name="last_name" class="_style_3vhmZK" placeholder="{{ trans('messages.user.lastname') }}" value="{{ $result->last_name }}">
					<span class="text-danger"> {{ $errors->first('last_name') }} </span>
				</div>
			</div>
		</div>
		<div class="parter-info separated--bottom col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 25px 0px 15px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding:6px 0px;">{{trans('messages.profile.location')}}</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6 p-0" >
				<select class="_style_3vhmZK " tabindex="-1" title="" id="rider_country" name="country_code" disabled="true">
					@foreach($country as $key => $value)
						<option value="{{$value->phone_code}}" {{$value->id == $result->country_id ? 'selected' : ''}} data-value="+{{ $value->phone_code}}">
							{{ $value->long_name}}
						</option>
					@endforeach
				</select>
				</div>
			</div>
		</div>
		<div class="parter-info separated--bottom col-lg-12 col-md-12 col-sm-12 col-xs-12" style=" padding: 25px 0px 15px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding:6px 0px;margin-top: 40px;"> 
					{{trans('messages.profile.profile_photo')}}
				</label>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 p-0">
					<div class="img--circle img--bordered img--shadow driver-avatar profile_update-loader " style="cursor: pointer;" id="click_image" ng-click="select_image();">
						@if($result->profile_picture==null || $result->profile_picture->src == '')
							<img src="{{url('images/user.jpeg')}}" >
						@else
							<img class="profile_picture" src="{{url($result->profile_picture->src)}}" >
						@endif
					</div>
					<input type="file" ng-model="profile_image" style="display:none" accept="image/*"
					id="file" name='profile_image' onchange="angular.element(this).scope().fileNameChanged(this)" />
				</div>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin: 40px 0;">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding:6px 0px;"> 
					{{trans('messages.profile.mobile')}}<em class="text-danger">*</em>
				</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pr_mob countrylist" style="padding:0px;">
					<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 pr_mob countrylist" style="padding:0px;">
						<span class="pull-left m-t-5" id="country_code" name="country_code">
							+{{ $result->country_code}}
						</span>
						<input type="hidden" id="mobile_country" name="mobile_country" value="{{ $result->country_code }}">
						<input type="text" name="mobile_number" class="_style_3vhmZK phone-no" placeholder="{{ trans('messages.profile.mobile') }}" id="mobile" value="{{ $result->mobile_number }}" readonly>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding:0px;">
				      <input type="button" class="_style_3vhmZK" name="change_number" value="{{ trans('messages.profile.change') }}" id="submit-btn" ng-click="changeNumberPopup('show_popup')">
				    </div>
				</div>
				<span class="text-danger"> {{ $errors->first('mobile_number')}} </span>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding:6px 0px;"> 
					{{trans('messages.profile.gender')}}<em class="text-danger">*</em>
				</label>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-6  countrylist" style="padding:0px;">
						<input type="text" name="gender" value="{{ $result->gender_text }}" class="_style_3vhmZK phone-no" disabled>
					</div>
			</div>
		</div>
		<div class="parter-info separated--bottom col-lg-12 col-md-12 col-sm-12 col-xs-12" style="    padding: 25px 0px 15px;">
			<div class="col-lg-12 col-md-6 col-sm-6 col-xs-12">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="padding:6px 0px;">
					{{trans('messages.profile.email')}} <em class="text-danger">*</em>
				</label>
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="padding:0px 5px;"> 
					<input type="email" name="email" class="_style_3vhmZK" placeholder="{{ trans('messages.user.email') }}" value="{{ $result->email }}">
					<span class="text-danger"> {{ $errors->first('email')}} </span>
				</div>
			</div>
		</div>
		<div class="page-lead separated--bottom  text--center col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-bottom:30px;">
			<button style="padding: 0px 60px !important;font-size: 14px !important;" type="submit" class="btn btn--primary btn-blue"> {{trans('messages.dashboard.save')}} </button>
		</div>
		</form>
	</div>
</div>
</div>
</div>
</div>
</main>
@stop
