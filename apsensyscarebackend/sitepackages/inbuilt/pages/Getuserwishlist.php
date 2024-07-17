<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        //echo $user;
        $json_data = array();
        $Ids=array();
        $totalRow=$objQuery->fetchValues("`product_id`","`wishlist`","`user_id`='".$user."'");
        if($totalRow){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            unset($_SESSION['LoginSuccess']);
            $_SESSION['LoginSuccess']=false;
            echo "false";
            die;
        }
        echo json_encode(['wishlist'=>$json_data]);
}
