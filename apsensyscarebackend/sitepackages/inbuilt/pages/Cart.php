<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $length = sizeOF($user[3]);
        $user_id = $user[4];
        $itemSize = $user[3];
        $cartQuantity = $user[2];
        $product_name = $user[1];
        $product_id = $user[0];
        $Date = date("Y-m-d h:i:sa");

        if($objQuery->deleteRows("`user_cart` WHERE  `user_id`='" . ($user_id) . "'") == true){
            for ($i = 0; $i < $length; $i++) {
                $objQuery->insertData("`user_cart`", "`user_id`='" . ($user_id) . "',`qty`='" . $cartQuantity[$i] . "',`size_value`='" . $itemSize[$i] . "',`product_id`='" . $product_id[$i] . "',`created_at`='" . $Date . "',`product_name`='" . $product_name[$i] . "'");
            }
        }else {
            http_response_code(500); exit;
        }
        
        
        // if($objQuery->insertData("`user_cart`","`user_id`='".($user_id)."',`qty`='".$cartQuantity."',`size_value`='".$itemSize."',`product_id`='".$product_id."',`created_at`='".$Date."',`product_name`='".$product_name."'")){
        //     echo 'true';
        // }else{
        //     echo "false";
        // }
}
