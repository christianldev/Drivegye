@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management">
  <section class="content-header">
    <h1> Edit Vehicle Model </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/vehicle_model') }}">Vehicle Model</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Vehicle Model Form</h3>
          </div>
          <form method="POST" action="{{ URL::to(LOGIN_USER_TYPE.'/edit-vehicle_model/'.$result->id) }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
            <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Vehicle Make<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select class="form-control" id="input_status" name="vehicle_make_id">
    <option value="" disabled>Select</option>
    @foreach($make as $makeId => $makeName)
        <option value="{{ $makeId }}" {{ $result->vehicle_make_id == $makeId ? 'selected' : '' }}>{{ $makeName }}</option>
    @endforeach
</select>
                <span class="text-danger">{{ $errors->first('vehicle_make_id') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Vehicle Model Name<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_make_name" name="model_name" value="{{ $result->model_name }}" placeholder="Vehicle Model Name">
                <span class="text-danger">{{ $errors->first('model_name') }}</span>
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
            <button type="submit" class="btn btn-default" name="cancel" value="cancel">Cancel</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection