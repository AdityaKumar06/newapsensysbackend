<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        $json_data = array();
        $paymeny_method_id=$user->paymentid;
        // echo $paymeny_method_id;
        // die;
        $recentOrdered=$objQuery->fetchResult("`shop_order`","`payment_method_id` = '$paymeny_method_id'"); 
        $shop_order = array();
        while($fetchRow= mysqli_fetch_assoc($recentOrdered))
        {
            $shop_order[]=$fetchRow;
        }
        // print_r($shop_order[0]);
        // die;
        
        // fetchinf order details
        $orderId=$shop_order[0]['order_id'];
        $orderedDetails=$objQuery->fetchResult("`order_line`","`order_id` = '$orderId'");
        $order_line = array();
        while($fetchRow= mysqli_fetch_assoc($orderedDetails))
        {
            $order_line[]=$fetchRow;
        }
        
        
        // fetching product details 
        $productId=$order_line[0]['product_id'];
        $order_id=$order_line[0]['order_id'];
        $productDetails=$objQuery->joinProductandOrder($productId,$order_id);
        $product = array();
        while($fetchRow= mysqli_fetch_assoc($productDetails))
        {
            $product[]=$fetchRow;
        }

        // fetching address details
        $addressId=$shop_order[0]['address_id'];
        $addressDetails=$objQuery->fetchSelectRows("`name`,`contact`,`pincode`,`city`,`state`,`house_flat_office`,`area_landmark`,`address_type`","`address`","`id` = '$addressId'");
        $address = array();
        while($fetchRow= mysqli_fetch_assoc($addressDetails))
        {
            $address[]=$fetchRow;
        }
        $data=json_encode(array('address'=>$address,'product'=>$product,'payment'=>$shop_order[0]['order_status']));
        // $addressEmail='';
        // foreach ($address[0] as $x => $y) {
        //     $addressEmail.='<td style="border: 1px solid #ddd;">'.$y.'</td>';
        // }   
        // echo $addressEmail;
        
        // $productEmail='';
        // foreach ($product[0] as $x => $y) {
        //     $productEmail.='<td style="border: 1px solid #ddd;">'.$y.'</td>';
        // }
        http_response_code(200);
        echo $data;
        die;
}
