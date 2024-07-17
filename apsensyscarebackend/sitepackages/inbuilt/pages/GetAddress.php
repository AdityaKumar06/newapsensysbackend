<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        //echo $user;
        $user=$user->userid;
        $json_data = array();
        $Ids=array();
        if($totalRow=$objQuery->fetchResult("`user_address`","`user_id`='".$user."'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $addressId=$fetchRow['address_id'];
                if($totalDRow=$objQuery->fetchResult("`address`","`id`='".$addressId."'")){
                    while($fetchDRow= mysqli_fetch_assoc($totalDRow))
                    {
                        $json_data[]=$fetchDRow;
                    }
                }
            }
        }else{
            unset($_SESSION['LoginSuccess']);
            $_SESSION['LoginSuccess']=false;
            echo "false";
            die;
        }
        echo json_encode(['address'=>$json_data]);
}
?>

