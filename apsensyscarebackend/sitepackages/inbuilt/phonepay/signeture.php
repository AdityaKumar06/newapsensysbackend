<?php
include("gateway-config.php");

$user = json_decode(file_get_contents('php://input'));
print_r($user);
die;

// $attributes  = array('razorpay_signature'  => $razorpay_signature,  'razorpay_payment_id'  => $razorpay_payment_id ,  'razorpay_order_id' => $razorpay_order_id);
// $order  = $api->utility->verifyPaymentSignature($attributes);
