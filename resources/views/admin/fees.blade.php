@extends('admin.template')
@section('main')
<div class="fees-wrap content-wrapper">
	<section class="content-header">
		<h1>
		Fees
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}">
					<i class="fa fa-dashboard"></i>
					Home
				</a>
			</li>
			<li>
				<a href="#">
					Fees
				</a>
			</li>
			<li class="active">
				Edit
			</li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"> Fees Form </h3>
					</div>
					<form action="fees" method="POST" class="form-horizontal">
                     @csrf
					<div class="box-body">
						<div class="form-group">
							<label for="input_service_fee" class="col-sm-3 control-label">Rider Service Fee</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="input-group">
									<input type="text" name="access_fee" value="{{ fees('access_fee') }}" class="form-control" id="input_service_fee" placeholder="Rider Service Fee">
									<div class="input-group-addon" >%</div>
									<span class="text-danger">{{ $errors->first('access_fee') }}</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_service_fee" class="col-sm-3 control-label">
								Driver Peak Fare
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="input-group">
									<input type="text" name="driver_peak_fare" value="{{ fees('driver_peak_fare') }}" class="form-control" id="input_driver_peak_fare" placeholder="Driver Peak Fare">
									<div class="input-group-addon" >%</div>
									<span class="text-danger">{{ $errors->first('driver_peak_fare') }}</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_additional_rider_fare" class="col-sm-3 control-label">
								2nd Rider Amount <small>(For Pool Trips)</small>
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="input-group">
									<input type="text" name="additional_rider_fare" value="{{ fees('additional_rider_fare') }}" class="form-control" id="input_additional_rider_fare" placeholder="Additional Rider Fare">
									<div class="input-group-addon" >%</div>
									<span class="text-danger">{{ $errors->first('additional_rider_fare') }}</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_service_fee" class="col-sm-3 control-label">
								Driver Service Fee
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="input-group">
									<input type="text" name="driver_service_fee" value="{{ fees('driver_access_fee') }}" class="form-control" id="input_driver_service_fee" placeholder="Driver Service Fee">
									<div class="input-group-addon" >%</div>
									<span class="text-danger">{{ $errors->first('driver_service_fee') }}</span>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="input_additional_fee" class="col-sm-3 control-label">
								Apply Trip Additional Fee
							</label>
							<div class="col-md-7 col-sm-offset-1">
								<div class="input-group">
									<select name="additional_fee" class="form-control" id="input_additional_fee">
                               <option value="Yes" {{ fees('additional_fee') === 'Yes' ? 'selected' : '' }}>Yes</option>
                               <option value="No" {{ fees('additional_fee') === 'No' ? 'selected' : '' }}>No</option>
                                </select>
									<span class="text-danger">{{ $errors->first('additional_fee') }}</span>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer text-center">
						<button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
						<button type="reset" class="btn btn-default" name="cancel">Cancel</button>
					</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection
@push('scripts')
<style type="text/css">
	.input-group-addon {
		background-color: #eee !important;
	}
</style>
@endpush
