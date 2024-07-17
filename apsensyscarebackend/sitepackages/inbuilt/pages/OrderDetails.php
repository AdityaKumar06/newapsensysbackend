<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $orderId=json_decode(file_get_contents('php://input')) ;
        $orderId=$orderId->order_id;
        $shoporder = array();
        $order_line = array();
        $user = array();
        $address = array();
        if($totalRow=$objQuery->fetchResult('`shop_order`',"`order_id`='$orderId'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $shoporder[] = $fetchRow;
            }
            
            
            // print_r($shoporder[0]['user_id']);die;
            if($totalRow=$objQuery->orderDetails($orderId)){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    $order_line[] = $fetchRow;
                }
            }
            $userId=$shoporder[0]['user_id'];
            // echo $userId;die;
            if($totalRow=$objQuery->fetchResult('`site_user`',"`userId`='$userId'")){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    $user[] = $fetchRow;
                }
            }
            $address_id=$shoporder[0]['address_id'];
             if($totalRow=$objQuery->fetchResult('`address`',"`id`='$address_id'")){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    $address[] = $fetchRow;
                }
            }
        }else{
            echo "false";
        }
        echo json_encode(['shoporder'=>$shoporder,'order_line'=>$order_line,'user'=>$user,'address'=>$address]);
}
?>

