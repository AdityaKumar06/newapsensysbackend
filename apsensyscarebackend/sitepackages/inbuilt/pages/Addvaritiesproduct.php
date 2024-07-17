<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $varities = json_decode(file_get_contents('php://input'));
        // print_r($varities);
        // die;
        
        
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $sku = '';
        $length = strlen($characters);
    
        for ($i = 0; $i < 10; $i++) {
            $sku .= $characters[mt_rand(0, $length - 1)];
        }
        
        $price = $varities->price;
        $sizeid = $varities->size_id;
        $stock = $varities->stock_qty;
        $productId = $varities->productId;
        
        if ($objQuery->insertData("`product_entry`", "`product_id`='".$productId."',`price`='" . $price . "',`size_id`='" . $sizeid . "',`stock_qty`='" . $stock . "',`sku`='".$sku."'")) {
             http_response_code(200);
        } else {
             http_response_code(500);
        }
}
