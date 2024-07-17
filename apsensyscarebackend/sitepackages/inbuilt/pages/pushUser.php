<?php
session_start();
$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        $json_data = array();
        if($totalRow=$objQuery->fetchResult("`site_user`","`id`='".$user."'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[] = $fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['details'=>$json_data]);
}
?>

