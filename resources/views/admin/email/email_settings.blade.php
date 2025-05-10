@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Email Settings
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Email Settings</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" ng-controller="email_settings">
    <div class="row" ng-cloak>
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Email Settings Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="email_settings" method="POST" class="form-horizontal">
    @csrf
          <div class="box-body"  ng-init="email_driver='{{ old('driver',$result[0]->value) }}';smtp_username='{{$result[6]->value}}';smtp_password='{{$result[7]->value}}';saved_domain='{{$result[8]->value}}';saved_secret='{{$result[9]->value}}';">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_driver" class="col-sm-3 control-label">
                Driver<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_driver" placeholder="Driver" ng-model="email_driver" ng-change="change_driver();" name="driver">
                <span class="text-danger">{{ $errors->first('driver') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_host" class="col-sm-3 control-label">
                Host<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_host" placeholder="Host" value="{{ $result[1]->value }}" name="host">
                <span class="text-danger">{{ $errors->first('host') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_port" class="col-sm-3 control-label">
                Port<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_port" placeholder="Port" value="{{ old('port', $result[2]->value) }}" name="port">
                <span class="text-danger">{{ $errors->first('port') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_from_address" class="col-sm-3 control-label">
                From Address<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_from_address" placeholder="From Address" value="{{ old('from_address', $result[3]->value) }}" name="from_address">
                <span class="text-danger">{{ $errors->first('from_address') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_from_name" class="col-sm-3 control-label">
                From Name<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_from_name" placeholder="From Name" value="{{ old('from_name', $result[4]->value) }}" name="from_name">
                <span class="text-danger">{{ $errors->first('from_name') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_encryption" class="col-sm-3 control-label">
                Encryption<em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_encryption" placeholder="Encryption" value="{{ old('encryption', $result[5]->value) }}" name="encryption">
                <span class="text-danger">{{ $errors->first('encryption') }}</span>
              </div>
            </div>
            <div id="smtp_details" ng-hide="email_driver == 'mailgun'">
              <div class="form-group">
                <label for="input_username" class="col-sm-3 control-label">
                  Username<em class="text-danger">*</em>
                </label>
                <div class="col-md-7 col-sm-offset-1">
                  <input type="text" class="form-control" id="input_username" placeholder="Username" value="{{ old('username', $result[6]->value) }}" name="username">
                  <span class="text-danger">{{ $errors->first('username') }}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="input_password" class="col-sm-3 control-label">
                  Password<em class="text-danger">*</em>
                </label>
                <div class="col-md-7 col-sm-offset-1">
                  <input type="password" class="form-control" id="input_password" placeholder="Password" value="{{ old('password', $result[7]->value) }}" name="password">
                  <span class="text-danger">{{ $errors->first('password') }}</span>
                </div>
              </div>
            </div>
            <div id="mailgun_details" ng-show="email_driver == 'mailgun'">
              <div class="form-group">
                <label for="input_domain" class="col-sm-3 control-label">
                  Domain<em class="text-danger">*</em>
                </label>
                <div class="col-md-7 col-sm-offset-1">
                  <input type="text" class="form-control" id="input_domain" placeholder="Domain Name" value="{{ old('domain', $result[8]->value) }}" name="domain">
                  <span class="text-danger">{{ $errors->first('domain') }}</span>
                </div>
              </div>
              <div class="form-group">
                <label for="input_secret" class="col-sm-3 control-label">
                  Secret Key<em class="text-danger">*</em>
                </label>
                <div class="col-md-7 col-sm-offset-1">
                  <input type="text" class="form-control" id="input_secret" placeholder="Secret" value="{{ old('secret', $result[9]->value) }}" name="secret">
                  <span class="text-danger">{{ $errors->first('secret') }}</span>
                </div>
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