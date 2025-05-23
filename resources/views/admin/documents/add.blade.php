@extends('admin.template')

@section('main')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <?php $page = isset($result) ? 'Edit' : 'Add'; ?>
      <h1>
         <?php echo $page; ?> Documents 
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url(LOGIN_USER_TYPE.'/documents') }}">Documents</a></li>
        <li class="active"><?php echo $page; ?></li>
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
              <h3 class="box-title"><?php echo $page; ?> Documents Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ url('admin/add_document') }}" class="form-horizontal">
    @csrf
              <div class="box-body">
              <span class="text-danger">(*)Fields are Mandatory</span>
               <div class="form-group">
                  <label for="input_language" class="col-sm-3 control-label">Language<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                    <select name="language" class="form-control" id="input_language" disabled>
    <option value="en">English</option>
    <!-- Add more options here -->
</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_status" class="col-sm-3 control-label">Document For<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                   <select name="type" class="form-control" id="input_type">
    <option value="Driver" {{ ($result->type ?? '') === 'Driver' ? 'selected' : '' }}>Driver</option>
    <option value="Vehicle" {{ ($result->type ?? '') === 'Vehicle' ? 'selected' : '' }}>Vehicle</option>
    <option value="Company" {{ ($result->type ?? '') === 'Company' ? 'selected' : '' }}>Company</option>
</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_name" class="col-sm-3 control-label">Document Name<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                    <input type="text" name="document_name" value="{{ $result->document_name ?? '' }}" class="form-control" id="input_document_name" placeholder="Document Name">
                    <span class="text-danger">{{ $errors->first('document_name') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_code" class="col-sm-3 control-label">Country<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                   <select name="country" class="form-control" id="input_country">
    @foreach ($country as $key => $value)
        <option value="{{ $key }}" {{ isset($result->country_code) && $result->country_code == $key ? 'selected' : '' }}>
            {{ $value }}
        </option>
    @endforeach
</select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_suggested" class="col-sm-3 control-label">Expire On Date<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                    <select name="expire_on_date" class="form-control" id="input_expire">
    <option value="" disabled selected>Select</option>
    <option value="Yes" {{ isset($result->expire_on_date) && $result->expire_on_date == 'Yes' ? 'selected' : '' }}>Yes</option>
    <option value="No" {{ isset($result->expire_on_date) && $result->expire_on_date == 'No' ? 'selected' : '' }}>No</option>
</select>
                    <span class="text-danger">{{ $errors->first('expire_on_date') }}</span>
                  </div>
                </div>
                <div class="form-group">
                  <label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
                  <div class="col-md-7 col-sm-offset-1">
                    <select name="status" class="form-control" id="input_status">
    <option value="Active" {{ isset($result->status) && $result->status == 'Active' ? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{ isset($result->status) && $result->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
</select>
                  </div>
                </div>


                <div class="panel" ng-init="translations = {{json_encode(old('translations') ?: ($result->translate ?? array()))}}; removed_translations =  []; errors = {{json_encode($errors->getMessages())}};" ng-cloak>
                  <div class="panel-header">
                    <h4 class="box-title text-center">Translations</h4>
                  </div>
                  <div class="panel-body">
                    <input type="hidden" name="removed_translations" ng-value="removed_translations.toString()">
                    <div class="row" ng-repeat="translation in translations">
                      <input type="hidden" name="translations[@{{$index}}][id]" value="@{{translation.id}}">
                      <div class="form-group">
                        <label for="input_language_@{{$index}}" class="col-sm-3 control-label">Language<em class="text-danger">*</em></label>
                        <div class="col-md-7 col-sm-offset-1">
                          <select name="translations[@{{$index}}][locale]" class="form-control inactive_translate" id="input_language_@{{$index}}" ng-model="translation.locale" >
                            <option value="" ng-if="translation.locale == ''">Select Language</option>
                            @foreach($languages as $key => $value)
                              <option value="{{$key}}" ng-if="(('{{$key}}' | checkKeyValueUsedInStack : 'locale': translations) || '{{$key}}' == translation.locale) && '{{$key}}' != 'en'">{{$value}}</option>
                            @endforeach
                          </select>
                          <span class="text-danger ">@{{ errors['translations.'+$index+'.locale'][0] }}</span>
                        </div>
                        <div class="col-sm-1 p-0">
                          <button class="btn btn-danger btn-xs" ng-click="translations.splice($index, 1); removed_translations.push(translation.id)">
                            <i class="fa fa-trash"></i>
                          </button>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label">Document Name<em class="text-danger">*</em></label>
                        <div class="col-md-7 col-sm-offset-1">
                        <input type="text" class="form-control" id="input_name_" + index placeholder="Name">
                       <span class="text-danger" id="error_message_" + index></span>

                        <script>
                        var index = 0; // Set this to the appropriate index
                        var translationDocumentName = ''; // Set this to the appropriate value

                        // JavaScript logic to handle dynamic behavior
                        var inputElement = document.getElementById('input_name_' + index);
                        var errorMessageElement = document.getElementById('error_message_' + index);

                        inputElement.value = translationDocumentName;
                        errorMessageElement.textContent = ''; // Set the error message text here

                       // Add any event listeners or further logic as needed
                       </script>

                        </div>
                      </div>
                      <legend ng-if="$index+1 < translations.length"></legend>
                    </div>
                  </div>
                  <div class="panel-footer">
                    <div class="row" ng-show="translations.length <  {{count($languages) - 1}}">
                      <div class="col-sm-10 col-sm-offset-1 text-center">
                        <button type="button" class="btn btn-info" ng-click="translations.push({locale:''});" >
                          <i class="fa fa-plus"></i> Add Translation
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <input type="hidden" name="document_id" value="{{$result->id ?? ''}}">
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
