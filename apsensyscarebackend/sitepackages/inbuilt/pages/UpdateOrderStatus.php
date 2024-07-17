<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $status = json_decode(file_get_contents('php://input'));
        // print_r($status);
        // die;
        if(isset($status)){
            $order_id= $status->order_id;
            // echo($status_id);
            $order_status = $status->status;
        
        if ($objQuery->updateRow("`shop_order`", "`order_status`='" . $order_status . "'","`order_id`='$order_id'")) {
             http_response_code(200);
           echo "Success";
        } else {
             http_response_code(500);
            
            echo "somthing went wrong";
        }
        }else{
             http_response_code(500);
             echo "somthing went wrong";
        }
}
