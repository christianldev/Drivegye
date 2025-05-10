@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-controller="company_management" ng-init="login_user_type = '{{ LOGIN_USER_TYPE }}'; company_doc=''; errors = {{ json_encode($errors->getMessages()) }};">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Add Company
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/company') }}">Companies</a></li>
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
            <h3 class="box-title">Add Company Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form action="{{ url('admin/add_company') }}" method="POST" class="form-horizontal" enctype="multipart/form-data" id="company_form">
    @csrf
    <!-- Rest of your form fields and inputs go here -->
          <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_name" class="col-sm-3 control-label">Name <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="name" class="form-control" id="input_name" placeholder="Name">
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_vat_number" class="col-sm-3 control-label">VAT Number</label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="vat_number" id="input_vat_number" class="form-control" placeholder="VAT Number">
                <span class="text-danger">{{ $errors->first('vat_number') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_email" class="col-sm-3 control-label">Email <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="email" id="input_email" class="form-control" placeholder="Email">
                <span class="text-danger">{{ $errors->first('email') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_password" class="col-sm-3 control-label">Password <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="password" class="form-control" id="input_password" placeholder="Password" name="password">
                <span class="text-danger">{{ $errors->first('password') }}</span>
              </div>
            </div>

            <input type="hidden" name="user_type" value="Company">
            <div class="form-group">
              <label for="input_country_code" class="col-sm-3 control-label">Country Code<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
               
              <select name="country_code" class="form-control" id="input_country_code">
              <option value="" disabled selected>Select</option>
              @foreach($country_code_option as $codeValue => $codeLabel)
             <option value="{{ $codeValue }}">{{ $codeLabel }}</option>
             @endforeach
             </select>


                <span class="text-danger">{{ $errors->first('country_code') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Mobile Number <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
               <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number">
                <span class="text-danger">{{ $errors->first('mobile_number') }}</span>
              </div>
            </div> 

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Status <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <select name="status" id="input_status" class="form-control">
    <option value="" disabled selected>Select</option>
    <option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
    <option value="Pending">Pending</option>
</select>
                <span class="text-danger">{{ $errors->first('status') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Address Line <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
               <input type="text" name="address_line" id="address_line" class="form-control" placeholder="Address Line">
                <span class="text-danger">{{ $errors->first('address_line') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">City </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="city" id="city" class="form-control" placeholder="City">
                <span class="text-danger">{{ $errors->first('city') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">State</label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="state" id="state" class="form-control" placeholder="State">
                <span class="text-danger">{{ $errors->first('state') }}</span>
              </div>
            </div> 

            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">Postal Code <em class="text-danger">*</em> </label>
              <div class="col-md-7 col-sm-offset-1">

                <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="Postal Code">
                <span class="text-danger">{{ $errors->first('postal_code') }}</span>
              </div>
            </div>

            <div class="form-group">
              <label for="input_profile" class="col-sm-3 control-label">Profile</label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="file" class="form-control" id="input_profile" name="profile" accept="image/*">
                <span class="text-danger">{{ $errors->first('profile') }}</span>
              </div>
            </div>

            <div class="col-sm-12">
              <label class="col-sm-3"></label>
              <div class="loading d-none" id="company_loading"></div>
            </div>

            <div ng-repeat="doc in company_doc" ng-cloak ng-if="company_doc">
              <div class="form-group">
              <label class="col-sm-3 control-label">@{{doc.document_name}} <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="file" name="file_@{{doc.id}}" class="form-control">
                <span class="text-danger">@{{ errors['file_'+doc.id][0] }}</span>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label" ng-if="doc.expiry_required=='1'">Expire Date <em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1" ng-if="doc.expiry_required=='1'">
              <input type="text" min="{{ date('Y-m-d') }}" name="expired_date_@{{doc.id}}" class="form-control document_expired" placeholder="Expire date" autocomplete="off">
              <span class="text-danger">@{{ errors['expired_date_'+doc.id][0] }}</span>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label"> @{{doc.document_name}} Status<em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1">
              <select class ='form-control' name='@{{doc.doc_name}}_status'>
                <option value="0" ng-selected="doc.status==0">Pending</option>
                <option value="1" ng-selected="doc.status==1">Approved</option>
                <option value="2" ng-selected="doc.status==2">Rejected</option>
              </select>
            </div>
          </div>

          </div>

          <div class="form-group">
            <label for="input_service_fee" class="col-sm-3 control-label">Company Commission <em class="text-danger">*</em></label>
            <div class="col-md-7 col-sm-offset-1">
              <div class="input-group"> 
               <input type="text" name="company_commission" id="input_service_fee" class="form-control" placeholder="Company Commission" value="0">
                <div class="input-group-addon" style="background-color:#eee;">%</div>
                <span class="text-danger">{{ $errors->first('company_commission') }}</span>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
            <a href="{{url(LOGIN_USER_TYPE.'/company')}}"><span class="btn btn-default">Cancel</span></a>
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
@push('scripts')
<script>
  var datepicker_format = 'dd-mm-yy';
  $('#license_exp_date').datepicker({ 'dateFormat': datepicker_format, maxDate: new Date()});
  $(function () {
    $("#yearDate").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1950:' + new Date().getFullYear().toString(),
      dateFormat: datepicker_format,
    });
    $('.ui-datepicker').addClass('notranslate');
  });
  $('#insurance_exp_date').datepicker({ 'dateFormat': datepicker_format, maxDate: new Date()});
  $(function () {
    $("#yearDate").datepicker({
      changeMonth: true,
      changeYear: true,
      yearRange: '1950:' + new Date().getFullYear().toString(),
      dateFormat: datepicker_format,
    });
    $('.ui-datepicker').addClass('notranslate');
  });
</script>
@endpush
