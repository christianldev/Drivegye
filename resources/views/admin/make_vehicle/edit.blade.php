@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management">
  <section class="content-header">
    <h1> Edit Vehicle Make  </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/vehicle_make') }}">Vehicle Make</a></li>
        <li class="active">Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Vehicle Make Form</h3>
          </div>
          <form method="POST" action="{{ url(LOGIN_USER_TYPE.'/edit-vehicle-make/'.$result->id) }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
          <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Vehicle Make<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="make_vehicle_name" value="{{ $result->make_vehicle_name }}" class="form-control" id="input_make_name" placeholder="Make Name">
                <span class="text-danger">{{ $errors->first('make_vehicle_name') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="status" class="form-control" id="input_status">
    <option value="Active" {{ $result->status === 'Active' ? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{ $result->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
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
