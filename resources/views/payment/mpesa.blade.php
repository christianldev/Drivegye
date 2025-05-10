<!DOCTYPE html>
<html>
<head>
  <title>Mpesa Payment</title>
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
    <div class="payment-form" id="theme" style="margin-top:100px">
      <div class="main-header">
     <img src="{{ url('images/new/mpesa.png') }}" alt="Pay with Mpesa" width="180" class="CToWUd bot_footimg">
      </div>
      <form id="checkout_payment" method="post" action="{{route('payment.mpesa')}}">
        <input type="hidden" name="pay_key" id="nonce"> 
      
      <!-- Phone Number -->
      <div class="form-outline mb-9" style="margin-bottom:10px">
        <label class="form-label" for="PhoneNumber">Please Enter Phone Number</label>
        <input type="tel" id="PhoneNumber" name="phone_number" class="form-control" required minlength="10" maxlength="10" />
       <span id="phoneError" style="color: red; display: none;">Please enter a valid phone number with 10 digits.</span>
        <input type="hidden" name="amount" value="{{$amount}}"> 
        <input type="hidden" name="user_id" value="{{$user_id}}"> 
        <input type="hidden" name="pay_for" value="{{$pay_for}}">
        <input type="hidden" name="currency_code" value="{{$currency_code}}"> 
       
      </div>
    

      <!-- Submit button -->
      <button type="submit">Pay {{$currency_code}} {{$amount}}</button>

       </div>
       
     </form>
   </div>
 </main>
</body>





<script>
    var phoneNumberInput = document.getElementById('PhoneNumber');
    var phoneError = document.getElementById('phoneError');

    phoneNumberInput.addEventListener('input', function() {
        var phoneNumber = phoneNumberInput.value;
        if (phoneNumber.length < 10 || phoneNumber.length > 10) {
            phoneError.style.display = 'block';
        } else {
            phoneError.style.display = 'none';
        }
    });
</script>
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