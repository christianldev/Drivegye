@extends('admin.template')
@section('main')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		 Edit  Vehicle types
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{ url(LOGIN_USER_TYPE.'/vehicle_type') }}">Vehicle types </a></li>
			<li class="active"> Edit </li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Vehicle types Form</h3>
					</div>
					
<form method="POST" action="{{ url('admin/edit_vehicle_type/'.$result->id) }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
					<div class="box-body">
						<span class="text-danger">(*)Fields are Mandatory</span>
						<div class="form-group">
							<label for="input_name" class="col-sm-3 control-label">Name<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
							<input type="text" name="vehicle_name" value="{{ $result->car_name }}" class="form-control" id="input_name" placeholder="Name">

								<span class="text-danger">{{ $errors->first('vehicle_name') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_description" class="col-sm-3 control-label">Description</label>
							<div class="col-md-7 col-sm-offset-1">
								<textarea name="description" class="form-control" id="input_description" placeholder="Description" rows="3">{{ $result->description }}</textarea>
								<span class="text-danger">{{ $errors->first('description') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_license_back" class="col-sm-3 control-label">Vehicle image<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="file" name="vehicle_image" class="form-control" id="rc" accept="image/*">
								<span class="text-danger">{{ $errors->first('vehicle_image') }}</span>
								<img src="{{ $result->vehicle_image }}" style="width: auto;height: 100px;padding-top: 10px;">
							</div>
						</div>
						<div class="form-group">
							<label for="input_license_back" class="col-sm-3 control-label">Vehicle Active image<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<input type="file" name="active_image" class="form-control" id="rc" accept="image/*">
								<span class="text-danger">{{ $errors->first('active_image') }}</span>
								<img src="{{ $result->active_image }}" style="width: auto;height: 100px;padding-top: 10px;" >
							</div>
						</div>
						<div class="form-group">
							<label for="input_pool" class="col-sm-3 control-label"> Is Pool <em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="is_pool" class="form-control" id="input_pool">
    <option value="No" {{ $result->is_pool == 'No' ? 'selected' : '' }}>No</option>
    <option value="Yes" {{ $result->is_pool == 'Yes' ? 'selected' : '' }}>Yes</option>
</select>
								<span class="text-danger">{{ $errors->first('is_pool') }}</span>
							</div>
						</div>
						<div class="form-group">
							<label for="input_status" class="col-sm-3 control-label">Status<em class="text-danger">*</em></label>
							<div class="col-md-7 col-sm-offset-1">
								<select name="status" class="form-control" id="input_status">
    <option value="Active" {{ $result->status == 'Active' ? 'selected' : '' }}>Active</option>
    <option value="Inactive" {{ $result->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
</select>
<span class="text-danger">{{ $errors->first('status') }}</span>
								<span class="text-danger">{{ $errors->first('status') }}</span>
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
