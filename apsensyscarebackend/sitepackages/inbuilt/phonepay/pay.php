<?php
include("gateway-config.php");


$method = $_SERVER['REQUEST_METHOD'];
$user = json_decode(file_get_contents('php://input'));
$order_id = uniqid();
$name = $user->name;
$mobile = $user->phone;
// $amount = $user->amount; // amount in INR
$amount = $user->amount + 50; 
// echo $amount; die;
$merchantUserId = $user->merchantUserId;
$order = $user->order;

$merchantTransactionId = $order->merchantTransactionId;
// echo $merchantTransactionId;die;
$userAddress = $order->userAddress;
$date = date("Y/m/d");

switch ($method) {
    case "POST":

        if (count($order->products) > 0) {
            $products = $order->products;
            
            foreach ($products as $products) {
                $test = $objQuery->insertData("`order_line`", "`order_id`=' $order->OrderId ',`product_id`='$products->id',`ordered_price`='$products->price ',`ordered_bag_size`='$products->size',`quantity`=' $products->quantity' ");
                // print_r($test);
                // exit;
                // echo $test;
                // exit;
            }
            $date = date("d-M-Y");
            if ($objQuery->insertData("`shop_order`", "`user_id`='$merchantUserId',`order_id`=' $order->OrderId ',`order_date`='$date',`payment_method_id`='$merchantTransactionId',`address_id`='$userAddress',`shipping_method`='',`order_total`='$order->TotalAmount',`total_quantity`=' $products->quantity',`order_status`='payment panding',`created_at` = '$date'")) {
                $paymentData = array(
                    'merchantId' => $merchantId, // live ID 
                    'merchantTransactionId' => $merchantTransactionId, // live transactionID
                    "merchantUserId" => $merchantUserId,
                    'amount' => $amount * 100,// amount in paisa
                    'redirectUrl' => "https://apsensyscare.com/backend_api/payment/status",
                    'redirectMode' => "POST",
                    'callbackUrl' => "https://apsensyscare.com/backend_api/payment/status",
                    "merchantOrderId" => $order_id,
                    "mobileNumber" => $mobile,
                    "paymentInstrument" => array(
                        "type" => "PAY_PAGE",
                    )
                );
                $jsonencode = json_encode($paymentData);
                $payloadMain = base64_encode($jsonencode);
                $salt_index = 1; //key index 1
                $payload = $payloadMain . "/pg/v1/pay" . $keyId;
                $sha256 = hash("sha256", $payload);
                $final_x_header = $sha256 . '###' . $salt_index;
                $request = json_encode(array('request' => $payloadMain));
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $URL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => $request,
                    CURLOPT_HTTPHEADER => [
                        "Content-Type: application/json",
                        "X-VERIFY: " . $final_x_header,
                        "accept: application/json"
                    ],
                ]);
                $response = curl_exec($curl);
                $err = curl_error($curl);

                // print_r($response);
                curl_close($curl);
                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $res = json_decode($response);

                    if (isset($res->success) && $res->success == '1') {
                        $paymentCode = $res->code;
                        $paymentMsg = $res->message;
                        $payUrl = $res->data->instrumentResponse->redirectInfo->url;
                        $json_data = json_encode(['url' => $payUrl]);
                        http_response_code(200);
                        echo $json_data;
                    } else {
                        $paymentCode = $res->code; // response is KEY_NOT_CONFIGURED
                        echo $paymentCode;
                        $json_data = json_encode(['url' => $payUrl, 'code' => $paymentCode]);
                        http_response_code(500);
                        echo $json_data;
                    }
                }
            } else {
                http_response_code(500);
                echo json_encode(array(
                    'status' => 500,
                    'message' => "Internal Server Error"
                ));
            }
        }
}
