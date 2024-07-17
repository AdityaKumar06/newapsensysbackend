<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        $json_data = array();
        if($totalRow=$objQuery->fetchResult("`user_cart`","`user_id`='".$user."'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['cartItems'=>$json_data]);
}
