@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management" ng-init="login_user_type = '{{ LOGIN_USER_TYPE }}'; driver_doc = ''; errors = {{ json_encode($errors->getMessages()) }};">
	<section class="content-header">
		<h1> Edit Driver </h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"> <i class="fa fa-dashboard"></i> Home </a>
			</li>
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/driver') }}"> Drivers </a>
			</li>
			<li class="active"> Edit </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Driver Form</h3>
					</div>
					<form action="{{ url(LOGIN_USER_TYPE.'/edit_driver/'.$result->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data" novalidate>
                     @csrf
                   <input type="hidden" name="user_id" id="user_id" value="{{ $result->id }}">

					<div class="box-body">
						<span class="text-danger">(*)Fields are Mandatory</span>
						<div class="form-group">
							<label for="input_first_name" class="col-sm-3 control-label">First Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
							<input type="text" name="first_name" value="{{ $result->first_name }}" class="form-control" id="input_first_name" placeholder="First Name">
								<span class="text-danger">{{ $errors->first('first_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_last_name" class="col-sm-3 control-label">Last Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="last_name" value="{{ $result->last_name }}" class="form-control" id="input_last_name" placeholder="Last Name">
								<span class="text-danger">{{ $errors->first('last_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_email" class="col-sm-3 control-label">Email<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" class="form-control" id="input_email" placeholder="Email" name="email" value="{{ $result->email }}">
								<span class="text-danger">{{ $errors->first('email') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_password" class="col-sm-3 control-label">Password</label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="password" class="form-control" id="input_password" placeholder="Password" name="password">
								<span class="text-danger">{{ $errors->first('password') }}</span>
							</div>
						</div>
						<input type="hidden" name="user_type" id="user_type" class="form-control" value="Driver">
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Country Code<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="country_id" class="form-control" id="input_country_code">
    <option value="" selected disabled>Select</option>
    @foreach ($country_code_option as $key => $value)
        <option value="{{ $key }}" @if ($result->country_id == $key) selected @endif>{{ $value }}</option>
    @endforeach
</select>
								
								<span class="text-danger">{{ $errors->first('country_id') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="gender" class="col-sm-3 control-label">Gender <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
							<input type="radio" name="gender" value="1" class="form-check-input gender" id="g_male" {{ $result->getOriginal('gender') == '1' ? 'checked' : '' }}>
								<label for="g_male" style="font-weight: normal !important;">Male</label>
								<input type="radio" name="gender" value="2" class="form-check-input gender" id="g_female" {{ $result->getOriginal('gender') == '2' ? 'checked' : '' }}>
								<label for="g_female" style="font-weight: normal !important;">Female</label>
								<div class="text-danger">{{ $errors->first('gender') }}</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Mobile Number </label>
							<div class="col-md-7 col-sm-offset-1">
							<input type="text" name="mobile_number" value="{{ $result->env_mobile_number }}" class="form-control" id="mobile_number" placeholder="Mobile Number">
								<span class="text-danger">{{ $errors->first('mobile_number') }}</span>
							</div>
						</div>
						@if (LOGIN_USER_TYPE!='company')
						<div class="form-group">
							<label for="input_company" class="col-sm-3 control-label">Company Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="company_name_view" class="form-control" id="input_company_name" disabled>
    <option value="" selected disabled>Select</option>
    @foreach ($company as $key => $value)
        <option value="{{ $key }}" @if ($result->company_id == $key) selected @endif>{{ $value }}</option>
    @endforeach
</select>

<input type="hidden" name="company_name" value="{{ $result->company_id }}">
								<span class="text-danger">{{ $errors->first('company_name') }}</span>
							</div>
						</div>
						@endif
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
							<select name="status" class="form-control" id="input_status">
                             <option value="" disabled>Select</option>
                             <option value="Active" {{ $result->status == 'Active' ? 'selected' : '' }}>Active</option>
                             <option value="Inactive" {{ $result->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                             <option value="Pending" {{ $result->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                             <option value="Car_details" {{ $result->status == 'Car_details' ? 'selected' : '' }}>Car  Details</option>
                             <option value="Document_details" {{ $result->status == 'Document_details' ? 'selected' : '' }}>Document Details</option>
                            </select>

								<span class="text-danger">{{ $errors->first('status') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Address Line 1 </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="address_line1" value="{{ isset($address) ? $address->address_line1 : '' }}" class="form-control" id="address_line1" placeholder="Address Line 1">
								<span class="text-danger">{{ $errors->first('address_line1') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Address Line 2 </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="address_line2" value="{{ isset($address) ? $address->address_line2 : '' }}" class="form-control" id="address_line2" placeholder="Address Line 2">
								<span class="text-danger">{{ $errors->first('address_line2') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">City </label>
							<div class="col-md-7 col-sm-offset-1">
								
								<input type="text" name="city" value="{{ isset($address) ? $address->city : '' }}" class="form-control" id="city" placeholder="City">
								<span class="text-danger">{{ $errors->first('city') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">State</label>
							<div class="col-md-7 col-sm-offset-1">
								
								<input type="text" name="state" value="{{ $address->state }}" class="form-control" id="state" placeholder="State">
								<span class="text-danger">{{ $errors->first('state') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Postal Code </label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="text" name="postal_code" value="{{ $address->postal_code }}" class="form-control" id="postal_code" placeholder="Postal Code">
								<span class="text-danger">{{ $errors->first('postal_code') }}</span>
							</div>
						</div>

						<div class="col-sm-12">
							<label class="col-sm-3"></label>
							<div class="loading d-none" id="document_loading"></div>
						</div>
						
						<div class="form-group" ng-repeat="doc in driver_doc" ng-cloak ng-if="driver_doc">
							<label class="col-sm-3 control-label"> @{{doc.document_name}}<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="file" name="file_@{{doc.id}}" class="form-control">								
								<span class="text-danger">@{{ errors['file_'+doc.id][0] }}</span>
								<div class="license-img" ng-if=doc.document>
									<a href="@{{doc.document}}" target="_blank">
										<img style="width: auto;height: 100px;padding-top: 5px" ng-src="@{{doc.document}}">
									</a>
								</div>
								<div class="license-img" ng-if=!doc.document>
								<img style="width: auto;height: 100px; padding-top: 5px;" src="{{ url('images/driver_doc.png')}}">
								</div>
							</div></br></br>
							<div class="col-sm-12 p-0">
							<label class="col-sm-3 control-label" ng-if="doc.expiry_required=='1'">Expire Date <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1" ng-if="doc.expiry_required=='1'">
								<input type="text" name="expired_date_@{{doc.id}}" min="{{ date('Y-m-d') }}" value="@{{ doc.expired_date }}" class="form-control document_expired" placeholder="Expire date" autocomplete="off">
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
									<input type="text" name="account_holder_name" value="{{ @$result->default_payout_credentials->payout_preference->holder_name }}" class="form-control" id="account_holder_name" placeholder="Account Holder Name">
									<span class="text-danger">{{ $errors->first('account_holder_name') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Account Number <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="account_number" value="{{ @$result->default_payout_credentials->payout_preference->account_number }}" class="form-control" id="account_number" placeholder="Account Number">
									<span class="text-danger">{{ $errors->first('account_number') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Name of Bank <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="bank_name" value="{{ @$result->default_payout_credentials->payout_preference->bank_name }}" class="form-control" id="bank_name" placeholder="Name of Bank">
									<span class="text-danger">{{ $errors->first('bank_name') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">Bank Location <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="bank_location" value="{{ @$result->default_payout_credentials->payout_preference->bank_location }}" class="form-control" id="bank_location" placeholder="Bank Location">
									<span class="text-danger">{{ $errors->first('bank_location') }}</span>
								</div>
							</div>
							<div class="form-group">
								<label for="input_status" class="col-sm-3 control-label">BIC/SWIFT Code <em class="text-danger">*</em></label>
								<div class="col-md-7 col-sm-offset-1">
									<input type="text" name="bank_code" value="{{ @$result->default_payout_credentials->payout_preference->branch_code }}" class="form-control" id="bank_code" placeholder="BIC/SWIFT Code">
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
