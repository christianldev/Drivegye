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
  <link rel="stylesheet" href="{{ asset('css/common1.css')}}">
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
        <img src="{{ url('images/new/paystack.png') }}" alt="Pay with Paystack" class="CToWUd bot_footimg">
      </div>
      <form id="paymentForm">
        <input type="hidden" name="pay_key" id="nonce"> 
        <input type="hidden" name="language" value="EN"> 
        <input type="hidden" name="currency" id="currency" value="{{$currency_code}}"> 
              
        <input type="hidden"id="amount"  name="amount" value="{{$amount}}"> 
        <input type="hidden" name="user_id" value="{{$user_id}}"> 
        <input type="hidden" name="pay_for" value="{{$pay_for}}">
       
     
      
       <!-- Email Address -->
      <div class="form-outline mb-4">
        <label class="form-label" for="Email">Email Address</label>
        <input type="email" name="email"class="form-control" id="email-address"class="form-control" required />
      </div>
       <!-- Billing Name -->
    
      <div class="form-outline mb-4">
        <label class="form-label" for="FirstName">Fisrt Names</label>
        <input  name="first_name" class="form-control"  id="first-name" class="form-control" required />
      </div>
        <!-- Phone Number -->
      <div class="form-outline mb-4">
        <label class="form-label" for="LastName">Last Name</label>
        <input  name="last_name" class="form-control" id="last-name" class="form-control" required/>
      </div>
   
      <!-- Phone Number -->
      <div class="form-outline mb-4">
        <label class="form-label" for="phoneNumber">Phone Number</label>
        <input  type="tel"name="phone" class="form-control" id="phone-number" class="form-control" required/>
      </div>
      <br>
      <!-- Submit button -->
       <button type="button" name="sub"onclick="payPageWithPaystack()">Pay {{$currency_code}} {{$amount}}</button>

       </div>
       
     </form>
   </div>
 </main>
   <!-- Bootstrap core JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script>
  function payPageWithPaystack(){
  // Get the input field values
  var email = document.getElementById('email-address').value;
  var firstName = document.getElementById('first-name').value;
  var lastName = document.getElementById('last-name').value;
  var phoneNumber = document.getElementById('phone-number').value;

  // Check if any of the input fields are empty
  if (email === '' || firstName === '' || lastName === '' || phoneNumber === '') {
    alert('Please fill in all required fields.');
    return; // Stop execution if any field is empty
  }      
      
  const api = "{{$public_key}}";
    var handler = PaystackPop.setup({
      key: api,
      email: document.getElementById("email-address").value,
      amount: {{$amount}}*100,
      currency: "NGN",
      ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      firstname: document.getElementById("first-name").value,
      lastname: document.getElementById("last-name").value,
      phone: document.getElementById("phone-number").value,
      // label: "Optional string that replaces customer email"
      metadata: {
         custom_fields: [
            {
                display_name: "First Name:",
                variable_name: "first_name",
                value: document.getElementById("first-name").value,
            },
             {
                display_name: "Last Name:",
                variable_name: "last_name",
                value: document.getElementById("last-name").value,
            },
             {
                display_name: "Phone Number:",
                variable_name: "phone_number",
                value: document.getElementById("phone-number").value,
            },
             {
                display_name: "Product Name",
                variable_name: "product_name",
                value: "{{ $site_name }}"
            }
         ]
      },
      callback: function(response){
           const referenced = response.reference;
		  window.location.href='{{$callback}}?payment_id={{ $payment_id }}&successfullypaid='+ referenced;
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }
</script>
</body>
 <script src="https://js.paystack.co/v1/inline.js"></script> 

</html>

