@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Wallet 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/wallet') }}">Wallet Code</a></li>
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
              <h3 class="box-title">Edit Wallet Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <form action="{{ route('edit_wallet', ['id' => $result->user_id, 'user_type' => $user_type]) }}" method="POST" class="form-horizontal">
    @csrf
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
               <div class="form-group">
                  <label for="user_id" class="col-sm-3 control-label">Username<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                    <select class="form-control" id="user_id" name="user_id" disabled>
    <option value="" disabled>Select...</option>
    @foreach ($users_list as $user_id => $user_name)
        <option value="{{ $user_id }}" {{ $user_id == $result->user_id ? 'selected' : '' }}>
            {{ $user_name }}
        </option>
    @endforeach
</select>
                    <span class="text-danger">{{ $errors->first('user_id') }}</span>
                  </div>
                  <input type='hidden' name='prev_user_id' value='{{$result->user_id}}'>
               </div>
                
                <div class="form-group">
                  <label for="input_amount" class="col-sm-3 control-label">Amount<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" class="form-control" id="input_amount" name="amount" value="{{ $result->original_amount }}" placeholder="Amount">
                    <span class="text-danger">{{ $errors->first('amount') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_currency_code" class="col-sm-3 control-label">Currency code<em class="text-danger">*</em></label>

                  <div class="col-md-7 col-sm-offset-1">
                    <select name="currency_code" class="form-control" id="input_currency_code">
    <option value="" disabled selected>Select</option>
    @foreach($currency as $code => $name)
        <option value="{{ $code }}" {{ $code == $result->currency_code ? 'selected' : '' }}>{{ $name }}</option>
    @endforeach
</select>
                    <span class="text-danger">{{ $errors->first('currency_code') }}</span>
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
@endsection

