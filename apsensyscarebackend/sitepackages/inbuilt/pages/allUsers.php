<?php

$method = $_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $user=json_decode(file_get_contents('php://input')) ;
        $id= $user->id ;
        //echo "hello";
        $json_data = array();
        if(isset($id)){
            if($totalRow=$objQuery->fetchResults("`site_user`")){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    unset($_SESSION['LoginSuccess']);
                    $token=$objQuery->getRandomHashCode();
                    $json_data[] = $fetchRow;
                }
            }else{
                unset($_SESSION['LoginSuccess']);
                $_SESSION['LoginSuccess']=false;
                echo "false";
                die;
            }
            echo json_encode(['details'=>$json_data]);
        }else{
            http_response_code(401);
            echo json_encode(array(
            'status' => 401, 
                'message' => "Authentication faild...."
            ));
        }
}