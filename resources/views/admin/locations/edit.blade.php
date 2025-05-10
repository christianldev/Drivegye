@extends('admin.template')
@section('main')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Edit Location
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('admin/locations') }}">Locations</a></li>
      <li class="active">Edit</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content" ng-controller='manage_locations'>
    <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <!-- Horizontal Form -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Edit Location Form</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form method="POST" action="{{ url('admin/edit_location/'.$result->id) }}" class="form-horizontal form">
    @csrf
          <div class="box-body" ng-init="formatted_coords={{ json_encode(old('formatted_coords',$result->co_ordinates)) }};coordinates=[]">
            <span class="text-danger">(*)Fields are Mandatory</span>
            <div class="form-group">
              <label for="input_name" class="col-sm-3 control-label">
                Name <em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
                <input type="text" class="form-control" id="input_name" placeholder="Name" name="name" value="{{ $result->name }}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
              </div>
            </div>
            <div class="form-group">
              <label for="input_status" class="col-sm-3 control-label">
                Status <em class="text-danger">*</em>
              </label>
              <div class="col-md-7 col-sm-offset-1">
              <select name="status" class="form-control" id="input_status">
              <option value="" disabled>Select</option>
              <option value="Active" {{ $result->status === 'Active' ? 'selected' : '' }}>Active</option>
              <option value="Inactive" {{ $result->status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
             </select>

                <span class="text-danger">{{ $errors->first('status') }}</span>
              </div>
            </div>
            <script> document.getElementById('coordinates').value = coordinatesValue; </script>
            <input type="hidden" name="coordinates" class="coordinates" id="coordinates">
          </div>
          <div class="box-body">
            <span class="text-danger">{{ old('location_set') }}</span>
            <span class="text-danger">{{ $errors->first('coordinates') }}</span>
            <input id="pac-input" class="controls hide" type="text" placeholder="Search here" style="padding: 5px;margin: 5px;">
            <div id="map" style="height: 500px;width: 100%;"></div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-center">
            <button type="submit" class="btn btn-info" name="submit" value="submit">Submit</button>
            <a href="{{ url('admin/locations') }}" class="btn btn-default" name="cancel" value="Cancel">
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