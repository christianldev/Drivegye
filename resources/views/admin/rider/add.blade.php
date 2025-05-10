@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="destination_admin">
	<section class="content-header">
		<h1> Add Rider </h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"> <i class="fa fa-dashboard"> </i> Home </a>
			</li>
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/rider') }}"> Riders </a>
			</li>
			<li class="active"> Add </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"> Add Rider Form </h3>
					</div>
					<form action="{{ url('admin/add_rider') }}" method="post" class="form-horizontal">
    @csrf <!-- Add CSRF token -->
					<div class="box-body">
						<span class="text-danger">(*)Fields are Mandatory</span>
						<div class="form-group">
							<label for="input_first_name" class="col-sm-3 control-label">First Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="first_name" id="input_first_name" class="form-control" placeholder="First Name">
								<span class="text-danger">{{ $errors->first('first_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_last_name" class="col-sm-3 control-label">Last Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="last_name" id="input_last_name" class="form-control" placeholder="Last Name">
								<span class="text-danger">{{ $errors->first('last_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_email" class="col-sm-3 control-label">Email<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="email" id="input_email" class="form-control" placeholder="Email">
								<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_password" class="col-sm-3 control-label">Password<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="password" class="form-control" id="input_password" placeholder="Password" name="password">
								<span class="text-danger">{{ $errors->first('password') }}</span>
							</div>
						</div>
						<input type="hidden" name="user_type" id="user_type" value="Rider">
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Country Code<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select class ='form-control' id = 'input_country_code' name='country_code' >
									@foreach($country_code_option as $country_code)
									<option value="{{@$country_code->phone_code}}" data-id="{{ $country_code->id }}" {{ ($country_code->id == old('country_id')) ? 'Selected' : ''}}>{{$country_code->long_name}}</option>
									@endforeach
									<input type="hidden" name="country_id" id="country_id" value="{{ old('country_id') }}">
								</select>
								<span class="text-danger">{{ $errors->first('country_code') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="gender" class="col-sm-3 control-label">Gender <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
							<input type="radio" name="gender" value="1" class="form-check-input gender" id="g_male">
								<label for="g_male" style="font-weight: normal !important;">Male</label>
								<input type="radio" name="gender" value="2" class="form-check-input gender" id="g_female">
								<label for="g_female" style="font-weight: normal !important;">Female</label>
								<div class="text-danger">{{ $errors->first('gender') }}</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Mobile Number <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number">
								<span class="text-danger">{{ $errors->first('mobile_number') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_password" class="col-sm-3 control-label">Home Location</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="autocomplete-input-container">
									<div class="autocomplete-input">
										<input type="text" name="home_location" id="input_home_location" class="form-control" placeholder="Home Location" value="{{ isset($location->home_location) ? $location->home_location : '' }}" autocomplete="off">
									</div>
									<ul class="autocomplete-results home-autocomplete-results">
									</ul>
								</div>
								<span class="text-danger">{{ $errors->first('home_location') }}</span>
							</div>
						</div>
						<input type="hidden" name="home_latitude" id="home_latitude" class="form-control" value="{{ isset($location->home_latitude) ? $location->home_latitude : '' }}">
						<input type="hidden" name="home_longitude" id="home_longitude" class="form-control" value="{{ isset($location->home_longitude) ? $location->home_longitude : '' }}">
						<div class="form-group">
							<label for="input_password" class="col-sm-3 control-label">Work Location</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="autocomplete-input-container">
									<div class="autocomplete-input">
										<input type="text" name="work_location" id="input_work_location" class="form-control" value="{{ isset($location->work_location) ? $location->work_location : '' }}" placeholder="Work Location" autocomplete="off">
									</div>
									<ul class="autocomplete-results work-autocomplete-results">
									</ul>
								</div>
								<span class="text-danger">{{ $errors->first('work_location') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="status" class="form-control" id="input_status">
    <option value="" selected disabled>Select</option>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
</select>
								<span class="text-danger">{{ $errors->first('status') }}</span>
							</div>
						</div>
						<input type="hidden" name="work_latitude" value="{{ @$location->work_latitude }}" class="form-control" id="work_latitude">
						<input type="hidden" name="work_longitude" value="{{ @$location->work_longitude }}" id="work_longitude">
					</div>
					<div class="box-footer text-center">
						<button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
						<button type="submit" class="btn btn-default" name="cancel" value="cancel">Cancel</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
