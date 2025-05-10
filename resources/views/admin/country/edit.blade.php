@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Country
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/country') }}">Country</a></li>
        <li class="active">Edit</li>
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
              <h3 class="box-title">Edit Country Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ $result->id }}" method="POST" class="form-horizontal">
             @csrf
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
                <div class="form-group">
                  <label for="input_short_name" class="col-sm-3 control-label">Short Name<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="short_name" value="{{ $result->short_name }}" class="form-control" id="input_short_name" placeholder="Short Name" readonly>
                    <span class="text-danger">{{ $errors->first('short_name') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_long_name" class="col-sm-3 control-label">Long Name<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="long_name" value="{{ $result->long_name }}" class="form-control" id="input_long_name" placeholder="Long Name">
                    <span class="text-danger">{{ $errors->first('long_name') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_iso3" class="col-sm-3 control-label">ISO3</label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="iso3" value="{{ $result->iso3 }}" class="form-control" id="input_iso3" placeholder="ISO3">
                    <span class="text-danger">{{ $errors->first('iso3') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_num_code" class="col-sm-3 control-label">Num Code</label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="num_code" value="{{ $result->num_code }}" class="form-control" id="input_num_code" placeholder="Num Code">
                    <span class="text-danger">{{ $errors->first('num_code') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_phone_code" class="col-sm-3 control-label">Phone Code<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="phone_code" value="{{ $result->phone_code }}" class="form-control" id="input_phone_code" placeholder="Phone Code">
                    <span class="text-danger">{{ $errors->first('phone_code') }}</span>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
                 <button type="submit" class="btn btn-default" name="cancel" value="cancel">Cancel</button>
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