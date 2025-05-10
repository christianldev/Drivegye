@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Add Mobile App Version
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('admin/mobile_app_version') }}">Mobile App Versions</a></li>
      <li class="active">Add</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Mobile App Version Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form method="POST" action="{{ url('admin/add_app_version') }}" class="form-horizontal form">
  @csrf
          <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_name" class="col-sm-3 control-label">Version<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="version" class="form-control" id="input_name" placeholder="Version">
                <span class="text-danger">{{ $errors->first('version') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Device Type<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="device_type" class="form-control" id="input_status" placeholder="Select">
    <option value="" disabled selected>Select</option>
    <option value="1">Apple</option>
    <option value="2">Android</option>
</select>
                <span class="text-danger">{{ $errors->first('device_type') }}</span>
              </div>
            </div> 
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">User Type<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="user_type" class="form-control" id="input_status" placeholder="Select">
    <option value="" disabled selected>Select</option>
    <option value="0">Rider</option>
    <option value="1">Driver</option>
</select>
                <span class="text-danger">{{ $errors->first('user_type') }}</span>
              </div>
            </div>   
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Force Update<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="force_update" class="form-control" id="input_status" placeholder="Select">
    <option value="" disabled selected>Select</option>
    <option value="1">Yes</option>
    <option value="0">No</option>
</select>
                <span class="text-danger">{{ $errors->first('force_update') }}</span>
              </div>
            </div>   
          </div>         
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">
              Submit
            </button>
            <a href="{{ url('admin/mobile_app_version') }}" class="btn btn-default" name="cancel" value="Cancel">
            Cancel
            </a>            
          </div>
          <!-- /.box-footer -->
          </form>
        </div>
        <!-- /.box -->
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@stop