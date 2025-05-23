@extends('admin.template')

@section('main')
  <div class="content-wrapper" ng-controller='later_booking'>
    <section class="content-header">
      <h1>
        Manage Bookings
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(LOGIN_USER_TYPE.'/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bookings</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header" style="height: 54px;">
              <!-- <h3 class="box-title">Manage Bookings </h3> -->

            </div>
            <div class="box-body">
              {!! $dataTable->table() !!}
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="modal fade" id="cancel_popup" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title">Booking Cancel</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ url('admin/manual_booking/cancel') }}" class="form-horizontal manual_booking_cancel" id="manual_booking_cancel">
    @csrf
              <input type="hidden" name="manual_booking_id" ng-model="manual_booking_cancel_id">
              <div class="row">
                <div class="col-md-3">
                  Cancel Reason
                </div>
                <div class="col-md-7 col-sm-offset-1">
                  <select class="form-control cancel_reason_id" name="cancel_reason_id">
                    <option value="">Select</option>
                    @foreach($cancel_reasons as $cancel_reason)
                      <option value="{{$cancel_reason->id}}">{{$cancel_reason->reason}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  Reason
                </div>
                <div class="col-md-7 col-sm-offset-1">
                  <textarea class="form-control" id="input_cancel_reason" name="cancel_reason" placeholder="Cancel Reason"></textarea>
                </div>
              </div>
              <div class="row" align="center">
                <input type="submit" name="submit" class="btn btn-primary">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="cancel_reason_popup" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title">Booking Cancel Reason</h4>
          </div>
          <div class="modal-body">
            <p>Cancel By: <span class="cancel_by">@{{cancel_by}}</span></p>
            <p>Cancel Reason: <span class="cancel_reason">@{{cancel_reason}}</span></p>
            <p>Reason: <span class="reason">@{{cancel_reason}}</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
  <link rel="stylesheet" href="{{ url('css/buttons.dataTables.css') }}">
  <script src="{{ url('js/dataTables.buttons.js') }}"></script>
  <script src="{{ url('js/buttons.server-side.js') }}"></script>
  <script type="text/javascript">
    var REQUEST_URL = "{{url('/'.LOGIN_USER_TYPE)}}"; 
  </script>
  {!! $dataTable->scripts() !!}
@endpush
<style type="text/css">
  .fa-eye{
    font-size: 20px !important;
  }
</style>
