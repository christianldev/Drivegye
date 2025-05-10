<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
</head>

<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
<body ng-app="App" class="">

  <main>
    <div class="payment-form" id="theme">
      <div class="main-header">
        <div>{{$currency_code}} {{$amount}}</div>
      </div>
      <form id="checkout_payment" method="post" action="{{route('payment.success')}}">
        <input type="hidden" name="pay_key" id="nonce"> 
        <input type="hidden" name="payment_type" id="payment_type"> 
        @foreach($view as $key => $paymet_methods)
        <div class="row" >
         @if ($loop->even)
         <span style="text-align: center;">OR</span>
         @endif
         @include($paymet_methods['view'],['data' =>  ['currency_code' => $currency_code,'amount' => $amount,]+$paymet_methods] )
       </div>
       @endforeach
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