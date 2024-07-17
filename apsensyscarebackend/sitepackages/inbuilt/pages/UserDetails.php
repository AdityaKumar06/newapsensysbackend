<?php
session_start();
$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        //$id= $user->id ;
        $json_data = array();
        if(isset($user)){
            if($totalRow=$objQuery->fetchResult("`site_user`","`id`='".$user."'")){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    unset($_SESSION['LoginSuccess']);
                    $token=$objQuery->getRandomHashCode();
                    $json_data[] = $fetchRow;
                }
                http_response_code(200);
                echo json_encode(['details'=>$json_data]);
            }else{
                unset($_SESSION['LoginSuccess']);
                $_SESSION['LoginSuccess']=false;
                echo "false";
                die;
            }
            
        }
        break;
}
?>

