@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Currency
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/currency') }}">Currency</a></li>
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
              <h3 class="box-title">Edit Currency Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form action="{{ $result->id }}" method="POST" class="form-horizontal">
    @csrf
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
                <div class="form-group">
                  <label for="input_name" class="col-sm-3 control-label">Name<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" class="form-control" id="input_name" placeholder="Name" name="name" value="{{ $result->name }}">
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_code" class="col-sm-3 control-label">Code<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="code" value="{{ $result->code }}" class="form-control" id="input_code" placeholder="Code">
                    <span class="text-danger">{{ $errors->first('code') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_symbol" class="col-sm-3 control-label">Symbol<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="symbol" value="{{ $result->symbol }}" class="form-control" id="input_symbol" placeholder="Symbol">
                    <span class="text-danger">{{ $errors->first('symbol') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_rate" class="col-sm-3 control-label">Rate<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="rate" value="{{ $result->rate }}" class="form-control" id="input_rate" placeholder="Rate">
                    <span class="text-danger">{{ $errors->first('rate') }}</span>
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