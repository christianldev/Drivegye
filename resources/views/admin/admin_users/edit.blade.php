@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Admin User
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/admin_user') }}">Admin Users</a></li>
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
              <h3 class="box-title">Edit Admin User Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{{ $result->id }}" method="POST" class="form-horizontal">
            @csrf
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
                <div class="form-group">
                  <label for="input_username" class="col-sm-3 control-label">Username<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                  <input type="text" name="username" value="{{ $result->username }}" class="form-control" id="input_username" placeholder="Username">
                    <span class="text-danger">{{ $errors->first('username') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_email" class="col-sm-3 control-label">Email<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                  <input type="text" name="email" value="{{ $result->email }}" class="form-control" id="input_email" placeholder="Email">
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_password" class="col-sm-3 control-label">Password</label>

                  <div class="col-md-7 col-sm-offset-1">
                  <input type="password" name="password" class="form-control" id="input_password" placeholder="Password">
                    <em>Enter new password only. Leave blank to use existing password.</em>
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="input_country_code" class="col-sm-3 control-label">
                    Country Code  <em class="text-danger">*</em>
                  </label>
                  <div class="col-md-7 col-sm-offset-1">
                    <select class='form-control' id = 'input_country_code' name='country_code' >
                      <option value="" disabled> Select </option>
                      @foreach($countries as $country_code)
                        <option value="{{@$country_code->id}}" {{ $country_code->id == $result->country_id ? 'Selected' : ''}} >{{$country_code->long_name}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('country_code') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="input_mobile_number" class="col-sm-3 control-label">Mobile Number (For SOS Purpose) <em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                  <input type="text" name="mobile_number" value="{{ old('mobile_number', $result->mobile_number) }}" class="form-control" id="input_mobile" placeholder="Mobile">
                    <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
                  </div>
                </div>

                <div class="form-group">
                  <label for="input_role" class="col-sm-3 control-label">Role<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                  <select name="role" class="form-control" id="input_role">
                 <option value="" disabled selected>Select</option>
                  @foreach($roles as $roleValue => $roleLabel)
                 <option value="{{ $roleValue }}" {{ @$result->roles->first()->id == $roleValue ? 'selected' : '' }}>{{    $roleLabel }}</option>
                  @endforeach
                </select>

                    <span class="text-danger">{{ $errors->first('role') }}</span>
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
                <button type="submit" class="btn btn-info " name="submit" value="submit">Submit</button>
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
