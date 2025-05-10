@extends('admin.template')
@section('main')
<div class="content-wrapper" ng-controller="driver_management">
  <section class="content-header">
    <h1> Edit Banner </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url(LOGIN_USER_TYPE.'/banner') }}">Banner</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Banner Form</h3>
          </div>
           <form action="{{ $result->id }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
          @csrf
            <div class="box-body">
            <span class="text-danger">(*)Fields are Mandatory</span>
            
            <div class="form-group">
              <label for="input_first_name" class="col-sm-3 control-label">Name<em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="name" value="{{ $result->title }}" class="form-control" id="input_name" placeholder="Name" {{ $editable }}>
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>

            <div class="form-group">
              @if($result->id == 1)
                <label for="input_first_name" class="col-sm-3 control-label">Number<em class="text-danger">*</em></label>
              @else
                <label for="input_first_name" class="col-sm-3 control-label">Link<em class="text-danger">*</em></label>
              @endif
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" name="link" value="{{ $result->link }}" class="form-control" id="input_link" placeholder="link">
                @if($result->id == 1)
                <small>Note* : Please fill it with the country code.(Ex-911234567890).</small>
                @endif
                <span class="text-danger">{{ $errors->first('link') }}</span>
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
         
          <div class="form-group">
              <label for="input_image" class="col-sm-3 control-label">Image <em class="text-danger">*</em></label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="file" name="image" class="form-control" id="input_image" accept="image/*">
                <span class="text-danger">{{ $errors->first('image') }}</span>
                <br>
                <img style="width:100px" src="{{url($result->url) }}">
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
