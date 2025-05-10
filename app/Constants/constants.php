<?php

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$cash_image = secure_asset("images/icon/cash.png");
} else {
	$cash_image = asset("images/icon/cash.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$paypal_image = secure_asset("images/icon/paypal.png");
} else {
	$paypal_image = asset("images/icon/paypal.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$paytm_image = secure_asset("images/icon/paytm.png");
} else {
	$paytm_image = asset("images/icon/paytm.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$flutterwave_image = secure_asset("images/icon/flutterwave.png");
} else {
	$flutterwave_image = asset("images/icon/flutterwave.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$card_image = secure_asset("images/icon/card.png");
} else {
	$card_image = asset("images/icon/card.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$mpesa_image = secure_asset("images/icon/mpesa.png");
} else {
	$mpesa_image = asset("images/icon/mpesa.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$paystack_image = secure_asset("images/icon/paystack.png");
} else {
	$paystack_image = asset("images/icon/paystack.png");
}

if(!App::runningInConsole() && request()->getScheme()=='https') {
	$razorpay_image = secure_asset("images/icon/razorpay.png");
} else {
	$razorpay_image = asset("images/icon/razorpay.png");
}


if(!App::runningInConsole() && request()->getScheme()=='https') {
	$mollie_image = secure_asset("images/icon/mollie.png");
} else {
	$mollie_image = asset("images/icon/mollie.png");
}

$payment_methods = array(
	["key" => "cash", "value" => 'Cash', 'icon' => $cash_image],
	["key" => "paypal", "value" => 'PayPal', 'icon' => $paypal_image],
	["key" => "braintree", "value" => 'Card Payment', 'icon' => $card_image],
	["key" => "stripe", "value" => 'Card Payment', 'icon' => $card_image],
	["key" => "paytm", "value" => 'Paytm', 'icon' => $paytm_image],
	["key" => "flutterwave", "value" => 'Flutterwave', 'icon' => $flutterwave_image],
	["key" => "mpesa", "value" => 'Mpesa', 'icon' => $mpesa_image],
	["key" => "razorpay", "value" => 'Razorpay', 'icon' => $razorpay_image],
	["key" => "paystack", "value" => 'Paystack', 'icon' => $paystack_image],
	["key" => "mollie", "value" => 'Mollie', 'icon' => $mollie_image],
);

if(!defined('PAYMENT_METHODS')) {
	define('PAYMENT_METHODS', $payment_methods);	
}

$payout_methods = array(
	["key" => "bank_transfer", "value" => 'Bank Transfer'],
	["key" => "paypal", "value" => 'PayPal'],
	["key" => "stripe", "value" => 'Stripe'],
);

if(!defined('PAYOUT_METHODS')) {
	define('PAYOUT_METHODS', $payout_methods);	
}

if(!defined('CACHE_HOURS')) {
	define('CACHE_HOURS', 24);	
}
