<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
</head>

<link rel="stylesheet" href="{{ asset('css/webpayment.css') }}">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common1.css')}}">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
  <link rel="stylesheet" href="{{ asset('css/home.css')}}">
  
  <link rel="stylesheet" href="{{ asset('css/popup.css')}}">

  <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.sliderTabs.min.css') }}">
  @if (Route::current()->uri() != 'driver_payment')
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"> 
  @endif
<body ng-app="App" class="">

  <main>
    <div class="payment-form" id="theme">
      <div class="main-header">
        <img src="{{ url('images/new/flutterwave.png') }}" alt="Pay with Flutterwave" class="CToWUd bot_footimg">
      </div>
      <form id="checkout_payment" method="post" action="{{route('payment.flutterwave')}}">
        <input type="hidden" name="pay_key" id="nonce"> 
      
      <!-- Phone Number -->
      <div class="form-outline mb-4">
        <label class="form-label" for="phoneNumber">Phone Number</label>
        <input type="tel" id="phoneNumber" class="form-control" required/>
       
      </div>
        <input type="hidden" name="amount" value="{{$amount}}"> 
        <input type="hidden" name="user_id" value="{{$user_id}}"> 
        <input type="hidden" name="pay_for" value="{{$pay_for}}">
        <input type="hidden" name="currency_code" value="{{$currency_code}}"> 
      <!-- Email Address -->
      <div class="form-outline mb-4">
        <label class="form-label" for="Email">Email Address</label>
        <input type="email" id="Email" name="email"class="form-control" required />
      </div>
      <br>
      <!-- Submit button -->
       <button type="submit">Pay {{$currency_code}} {{$amount}}</button>

       </div>
       
     </form>
   </div>
 </main>
</body>




<script src="{{ asset('js/jquery-1.11.3.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('js/angular.js') }}"></script>
<script src="{{ asset('js/angular-sanitize.js') }}"></script>

<script>
  var app = angular.module('App', ['ngSanitize']);
  var APP_URL = {!! json_encode(url('/')) !!};

    // Get URL to Create Dark theme
    const urlParams = new URLSearchParams(window.location.search);
    const myParam = urlParams.get('mode');
    var element = document.getElementById("theme");
    element.classList.add(myParam);

  </script>
  
  @stack('scripts')
  </html>