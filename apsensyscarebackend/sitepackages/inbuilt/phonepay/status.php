<?php 
include("gateway-config.php");
// include('./sitepackages/includes/include.php');
$method = $_SERVER['REQUEST_METHOD'];
// print_r($_POST);
// die;
function paymentStatus(){
     $marchant_id = $_POST['merchantId']; 
    $transaction_id = $_POST['transactionId']; 
    
    
    // Check Status API 
    $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/$marchant_id/$transaction_id";
    
    
    
    $salt_index = 1; //key index 1
    $payload = "/pg/v1/status/$marchant_id/$transaction_id$keyId";
    // echo $payload;
    $sha256 = hash("sha256", $payload);
    $final_x_header = $sha256 . '###' . $salt_index;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "X-MERCHANT-ID:".$marchant_id
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res = json_decode($response);
    }
    return $res;
}
function paymentRefund($POST,$objQuery){
  
    
    $merchantId = $POST['merchantId']; 
    $merchantTransactionId = $POST['transactionId']; 
    $amount=$POST['amount'];
    $merchantUserId = $objQuery->fetchSingleArrayValue("`user_id`","`shop_order`","`payment_method_id` = '$merchantTransactionId'");
    // return $merchantUserId;
    if($merchantUserId){
         // Check Status API 
        $paymentData = array(
                        'merchantId' => $merchantId, // test PGTESTPAYUAT
                        "merchantUserId" => $merchantUserId,
                        'originalTransactionId'=>$merchantTransactionId,
                        'merchantTransactionId' => rand(100,999).$merchantTransactionId, // test transactionID
                        'amount' => $amount ,
                        'callbackUrl'=>'https://apsensyscare.com/thankyou'
                    );
        
        $jsonencode = json_encode($paymentData);
        $payloadMain = base64_encode($jsonencode);
        $salt_index = 1; //key index 1
        $payload = $payloadMain."/pg/v1/refund$keyId";
        // echo $payload;
        $sha256 = hash("sha256", $payload);
        $final_x_header = $sha256 . '###' . $salt_index;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "X-VERIFY: " . $final_x_header,
            ],
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $res = json_decode($response);
            return $res;
        }
    }else{
        return [];
    }
    
    
   
}
// $response = paymentRefund($_POST);
// print_r ($_POST);exit;
if(isset($_POST['code'])&& $_POST['code']=="PAYMENT_SUCCESS" || $_POST['code']=="INTERNAL_SERVER_ERROR" || $_POST['code']=="PAYMENT_PENDING"){
    
    $marchant_id = $_POST['merchantId']; 
    $transaction_id = $_POST['transactionId']; 
    // Check Status API 
    $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/$marchant_id/$transaction_id";
    
    
    
    $salt_index = 1; //key index 1
    $payload = "/pg/v1/status/$marchant_id/$transaction_id$keyId";
    // echo $payload;
    $sha256 = hash("sha256", $payload);
    $final_x_header = $sha256 . '###' . $salt_index;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "X-VERIFY: " . $final_x_header,
            "X-MERCHANT-ID:".$marchant_id
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    // print_r("hello");
    // die;
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $res = json_decode($response);
        
       
        if (isset($res->success) && $res->success == true) {
            $payUrl = $res;

            $json_data = json_encode(['url' => $payUrl]);
            
            $paymeny_method_id =$payUrl->data->merchantTransactionId;
            
            $transaction_id =$payUrl->data->transactionId;
            
            $payment_type = $payUrl->data->paymentInstrument->type;
            
            $date=date("d-M-Y");
            
            
            $query = $objQuery->fetchNumRow("`shop_order`","`payment_method_id` = '$paymeny_method_id'");
            if($query == 1){
              $update_data = $objQuery->updateRow("`shop_order`","`order_status` = 'payment_success',`update_at` = '$date'","`payment_method_id` = '$paymeny_method_id'");
               if($update_data){
                   if($payment_type == "CARD"){
                       $card_type = $payUrl->data->paymentInstrument->cardType; 
                       $payment_provider = $payUrl->data->paymentInstrument->bankId;
                       $objQuery->insertData("`payments`","`payment_id` = '$paymeny_method_id',`transaction_id` = '$transaction_id',`payment_type` = '$payment_type',`payment_provider` = '$payment_provider',`card_type` = '$card_type',`created_at` = '$date'");
                   }
                   
                   if($payment_type == "NETBANKING"){
                       $payment_provider = $payUrl->data->paymentInstrument->bankId;
                       
                       $objQuery->insertData("`payments`","`payment_id` = '$paymeny_method_id',`transaction_id` = '$transaction_id',`payment_type` = '$payment_type',`payment_provider` = '$payment_provider',`created_at` = '$date'");
                   }
                   
                   if($payment_type=="UPI"){
                       $utr = $payUrl->data->paymentInstrument->utr;
                       $objQuery->insertData("`payments`","`payment_id` = '$paymeny_method_id',`transaction_id` = '$transaction_id',`payment_type` = '$payment_type',`utr_no` = '$utr',`created_at` = '$date'");
                   }
                    //  
                    
                    
                    header('Location: https://apsensyscare.com/thankyou?param='.$paymeny_method_id.'');
                    exit;
                }
            }
        }
        elseif(isset($res) && $res->code =='PAYMENT_DECLINED'){
            $paymeny_method_id =$res->data->merchantTransactionId;
            $update_data = $objQuery->updateRow("`shop_order`","`order_status` = 'PAYMENT_DECLINED',`update_at` = '$date'","`payment_method_id` = '$paymeny_method_id'");
            if($update_data){
                header('Location: https://apsensyscare.com/order-failed');
                exit;
            }
        }
        
    }
    
    
    
   
}
elseif(isset($_POST['code'])&&  $_POST['code']=="PAYMENT_ERROR" ||  $_POST['code']==="TIMED_OUT"){
    $response = paymentRefund($_POST,$objQuery);
    // print_r($response);
    // die;
    if($response){
        header('Location: https://apsensyscare.com/order-failed');
        exit;
    }
    header('Location: https://apsensyscare.com/order-failed');
    exit;
}



?>