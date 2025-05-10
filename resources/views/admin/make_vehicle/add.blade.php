@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management">
  <section class="content-header">
    <h1> Add Vehicle Make </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/vehicle_make') }}">Vehicle Make</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Vehicle Make Form</h3>
          </div>
          <form action="{{ LOGIN_USER_TYPE.'/add-vehicle-make' }}" method="POST" class="form-horizontal">
          <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Vehicle Make<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_make_name" name="make_vehicle_name" placeholder="Make Name">
                <span class="text-danger">{{ $errors->first('make_vehicle_name') }}</span>
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
          </div>
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
            <a href="{{ url(LOGIN_USER_TYPE.'/vehicle_make')  }}" class="btn btn-default">Cancel</a>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
