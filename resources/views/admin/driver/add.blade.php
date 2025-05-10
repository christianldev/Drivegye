@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management" ng-init="login_user_type = '{{ LOGIN_USER_TYPE }}'; driver_doc = {{ $driver_doc }}; errors = {{ json_encode($errors->getMessages()) }};">
	<section class="content-header">
		<h1> Add Driver </h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"> <i class="fa fa-dashboard"></i> Home </a>
			</li>
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/driver') }}"> Drivers </a>
			</li>
			<li class="active"> Add </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Add Driver Form</h3>
					</div>
					<form action="{{ url(LOGIN_USER_TYPE.'/add_driver') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                     @csrf
                   <input type="hidden" name="user_id" id="user_id" value="">

					<div class="box-body">
						<span class="text-danger">(*)Fields are Mandatory</span>
						<div class="form-group">
							<label for="input_first_name" class="col-sm-3 control-label">First Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="input_first_name" name="first_name" placeholder="First Name" value="{{ old('first_name') }}">
								<span class="text-danger">{{ $errors->first('first_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_last_name" class="col-sm-3 control-label">Last Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="input_last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}">
								<span class="text-danger">{{ $errors->first('last_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_email" class="col-sm-3 control-label">Email<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="email" value="{{ old('email') }}" class="form-control" id="input_email" placeholder="Email">
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
						<input type="hidden" name="user_type" id="user_type" class="form-control" value="Driver">
						<div class="form-group">
							<label for="input_country_code" class="col-sm-3 control-label">Country Code<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select class="form-control" id="input_country_code" name="country_id" placeholder="Select">
    <option value="" disabled selected>Select</option>
    <!-- Loop through country code options and generate option elements -->
    @foreach($country_code_option as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>

								
								<span class="text-danger">{{ $errors->first('country_id') }}</span>
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
								<input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
								<span class="text-danger">{{ $errors->first('mobile_number') }}</span>
							</div>
						</div>
						@if (LOGIN_USER_TYPE!='company')
						<div class="form-group">
							<label for="input_company" class="col-sm-3 control-label">Company Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select class="form-control" id="input_company_name" name="company_name">
    <option value="" disabled selected>Select</option>
    @foreach($company as $companyId => $companyName)
        <option value="{{ $companyId }}" {{ old('company_name') == $companyId ? 'selected' : '' }}>{{ $companyName }}</option>
    @endforeach
</select>
								<span class="text-danger">{{ $errors->first('company_name') }}</span>
							</div>
						</div>
						@endif
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="input_status" name="status" value="Car_details" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Address Line 1 </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="address_line1" name="address_line1" value="{{ old('address_line1') }}" placeholder="Address Line 1">
								<span class="text-danger">{{ $errors->first('address_line1') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Address Line 2 </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="address_line2" name="address_line2" value="{{ old('address_line2') }}" placeholder="Address Line 2">
								<span class="text-danger">{{ $errors->first('address_line2') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">City </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}" placeholder="City">
								<span class="text-danger">{{ $errors->first('city') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">State</label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}" placeholder="State">
								<span class="text-danger">{{ $errors->first('state') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Postal Code </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" placeholder="Postal Code">
								<span class="text-danger">{{ $errors->first('postal_code') }}</span>
							</div>
						</div>

						<div class="col-sm-12">
							<label class="col-sm-3"></label>
							<div class="loading d-none" id="document_loading"></div>
						</div>
						<div class="form-group" ng-repeat="doc in driver_doc" ng-cloak ng-if="driver_doc">
							<label class="col-sm-3 control-label">@{{doc.document_name}} <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="file" name="file_@{{doc.id}}" class="form-control">
								<span class="text-danger">@{{ errors['file_'+doc.id][0] }}</span>
							</div>
							<br>
							<br>
							<div class="col-sm-12 p-0">
							<label class="col-sm-3 control-label" ng-if="doc.expiry_required=='1'">Expire Date <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1" ng-if="doc.expiry_required=='1'">
								<input type="text" min="{{ date('Y-m-d') }}" name="expired_date_@{{doc.id}}" class="form-control document_expired" placeholder="Expire date" autocomplete="off">
								<span class="text-danger">@{{ errors['expired_date_'+doc.id][0] }}</span>
							</div>
						</div>
						<div class="col-sm-12 p-0">
							<label class="col-sm-3 control-label"> @{{doc.document_name}} Status<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select class ='form-control' name='@{{doc.doc_name}}_status'>
									<option value="0" ng-selected="doc.status==0">Pending</option>
									<option value="1" ng-selected="doc.status==1">Approved</option>
									<option value="2" ng-selected="doc.status==2">Rejected</option>
								</select>
							</div>
						</div>
						</div>
	
						@if(LOGIN_USER_TYPE!='company' || Auth::guard('company')->user()->id != 1)
						<span class="bank_detail">
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Account Holder Name <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" class="form-control" id="account_holder_name" name="account_holder_name" value="{{ old('account_holder_name') }}" placeholder="Account Holder Name">
									<span class="text-danger">{{ $errors->first('account_holder_name') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Account Number <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" class="form-control" id="account_number" name="account_number" value="{{ old('account_number') }}" placeholder="Account Number">
									<span class="text-danger">{{ $errors->first('account_number') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Name of Bank <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" class="form-control" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" placeholder="Name of Bank">
									<span class="text-danger">{{ $errors->first('bank_name') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Bank Location <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" class="form-control" id="bank_location" name="bank_location" value="{{ old('bank_location') }}" placeholder="Bank Location">
									<span class="text-danger">{{ $errors->first('bank_location') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">BIC/SWIFT Code <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" class="form-control" id="bank_code" name="bank_code" value="{{ old('bank_code') }}" placeholder="BIC/SWIFT Code">
									<span class="text-danger">{{ $errors->first('bank_code') }}</span>
								</div>
							</div>
						</span>
						@endif
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
