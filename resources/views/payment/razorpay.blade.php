<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
  
  
<link rel="stylesheet" href="{{ asset('css/webpayment.css') }}">

  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common1.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
  <link rel="stylesheet" href="{{ asset('css/home.css')}}">
  
  <link rel="stylesheet" href="{{ asset('css/popup.css')}}">

  <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.sliderTabs.min.css') }}">
  @if (Route::current()->uri() != 'driver_payment')
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"> 
  @endif
</head>


<body ng-app="App" class="">

  <main>
    <div class="payment-form" id="theme">
      <div class="main-header">
        <img src="{{ url('images/new/razorpay.png') }}" alt="Pay with Flutterwave" class="CToWUd bot_footimg">
      </div>
      <form name="razorpay_frm_payment" class="razorpay-frm-payment" id="razorpay-frm-payment" method="post">
        <input type="hidden" name="pay_key" id="nonce"> 
        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="{{$merchant_order_id}}"> 
        <input type="hidden" name="language" value="EN"> 
        <input type="hidden" name="currency" id="currency" value="{{$currency_code}}"> 
        <input type="hidden" name="surl" id="surl" value="{{$CALLBACK}}"> 
        <input type="hidden" name="furl" id="furl" value="{{$CALLBACK}}"> 
              
    
        <input type="hidden"id="amount"  name="amount" value="{{$amount}}"> 
        <input type="hidden" name="user_id" value="{{$user_id}}"> 
        <input type="hidden" name="pay_for" value="{{$pay_for}}">
       
       
      
       <!-- Email Address -->
      <div class="form-outline mb-4">
        <label class="form-label" for="Email">Email Address</label>
        <input type="email" name="billing_email"class="form-control" id="billing-email"class="form-control" required />
      </div>
       <!-- Billing Name -->
    
      <div class="form-outline mb-4">
        <label class="form-label" for="Email">Full Names</label>
        <input type="Email" name="billing_name" class="form-control"  id="billing-name" class="form-control" required />
      </div>
        <!-- Phone Number -->
      <div class="form-outline mb-4">
        <label class="form-label" for="phoneNumber">Phone Number</label>
        <input type="tel" name="billing_phone" class="form-control" id="billing-phone" class="form-control" required/>
       
      </div>
   
    
      <br>
      <!-- Submit button -->
       <button type="button" id="razor-pay-now">Pay {{$currency_code}} {{$amount}}</button>

       </div>
       
     </form>
   </div>
 </main>
   <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>


</html>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script type="text/javascript">
  jQuery(document).on('click', '#razor-pay-now', function (e) {
    var total = (jQuery('form#razorpay-frm-payment').find('input#amount').val() * 100);
    var merchant_order_id = jQuery('form#razorpay-frm-payment').find('input#merchant_order_id').val();
    var merchant_surl_id = jQuery('form#razorpay-frm-payment').find('input#surl').val();
    var merchant_furl_id = jQuery('form#razorpay-frm-payment').find('input#furl').val();
    var card_holder_name_id = jQuery('form#razorpay-frm-payment').find('input#billing-name').val();
    var merchant_total = total;
    var merchant_amount = jQuery('form#razorpay-frm-payment').find('input#amount').val();
    var currency_code_id = jQuery('form#razorpay-frm-payment').find('input#currency').val();
    var key_id = "{{$RAZOR_KEY_ID}}";
    var store_name = '{{ $site_name }}';
    var store_description = 'Payment';
    var store_logo = '{{ $logo_url }}';
    var email = jQuery('form#razorpay-frm-payment').find('input#billing-email').val();
    var phone = jQuery('form#razorpay-frm-payment').find('input#billing-phone').val();
    
    jQuery('.text-danger').remove();

    if(card_holder_name_id=="") {
      jQuery('input#billing-name').after('<small class="text-danger">Please enter full mame.</small>');
      return false;
    }
    if(email=="") {
      jQuery('input#billing-email').after('<small class="text-danger">Please enter valid email.</small>');
      return false;
    }
    if(phone=="") {
      jQuery('input#billing-phone').after('<small class="text-danger">Please enter valid phone.</small>');
      return false;
    }
    
    var razorpay_options = {
        callback_url: '{{$payment_callback}}',
        redirect: true,
        key: key_id,
        amount: merchant_total,
        name: store_name,
        description: store_description,
        image: store_logo,
        netbanking: true,
        currency: currency_code_id,
        prefill: {
            name: card_holder_name_id,
            email: email,
            contact: phone
        },
        notes: {
            soolegal_order_id: merchant_order_id,
        },
        handler: function (transaction) {
            jQuery.ajax({
                url:'callback.php',
                type: 'post',
                data: {razorpay_payment_id: transaction.razorpay_payment_id, merchant_order_id: merchant_order_id, merchant_surl_id: merchant_surl_id, merchant_furl_id: merchant_furl_id, card_holder_name_id: card_holder_name_id, merchant_total: merchant_total, merchant_amount: merchant_amount, currency_code_id: currency_code_id}, 
                dataType: 'json',
                success: function (res) {
                    if(res.msg){
                        alert(res.msg);
                        return false;
                    } 
                    window.location = res.redirectURL;
                }
            });
        },
        "modal": {
            "ondismiss": function () {
                // code here
            }
        }
    };
    // obj        
    var objrzpv1 = new Razorpay(razorpay_options);
    objrzpv1.open();
        e.preventDefault();
            
});
</script>