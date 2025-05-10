@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Additional Reason
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/additional-reasons') }}">Additional Reason</a></li>
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
              <h3 class="box-title">Add Additional Reason Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ url('admin/add-additional-reason') }}" method="post" class="form-horizontal">
            @csrf <!-- Add CSRF token -->
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
                <div class="form-group">
                  <label for="input_reason" class="col-sm-3 control-label">Reason<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="reason" class="form-control" id="input_reason" placeholder="Reason">
                    <span class="text-danger">{{ $errors->first('reason') }}</span>
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
              <!-- /.box-body -->
              <div class="box-footer text-center">
                <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
                <a href="{{ url(LOGIN_USER_TYPE.'/additional-reasons') }}" class="btn btn-default">Cancel</a>
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