@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management">
  <section class="content-header">
    <h1> Add Support </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/support') }}">Support</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Support Form</h3>
          </div>
          <form action="add_support" method="POST" class="form-horizontal" enctype="multipart/form-data">
           @csrf
          <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Name<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="name" class="form-control" id="input_name" placeholder="Name">
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
            
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Link<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="link" class="form-control" id="input_link" placeholder="link">
                <span class="text-danger">{{ $errors->first('link') }}</span>
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
               <!--  <small>Note* : If the link is a contact number,  Please fill it with country code.</small> -->
                <span class="text-danger">{{ $errors->first('status') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_owner" class="col-sm-3 control-label">Owner<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="owner" class="form-control" id="input_owner">
    <option value="" disabled selected>Select</option>
    <option value="Rider">Rider</option>
    <option value="Driver">Driver</option>
    <option value="All">All</option>
</select>
               <!--  <small>Note* : If the link is a contact number,  Please fill it with country code.</small> -->
                <span class="text-danger">{{ $errors->first('owner') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_image" class="col-sm-3 control-label">Image <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="file" name="image" class="form-control" id="input_image" accept="image/*">
                <span class="text-danger">{{ $errors->first('image') }}</span>
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
