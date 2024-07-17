<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        
        $user = json_decode(file_get_contents('php://input'));
        $email = $user->email;
        if ($objQuery->insertData("`unsubscribe`", "`email`='" . rawurlencode($email) . "'")) {
            http_response_code(200);
            echo json_encode(array(
                'status' => 200, // success or not?
                'message' => "Unsubscribe Successdf"
            ));
        } else {
            http_response_code(500);
            echo json_encode(array(
                'status' => 500, 
                'message' => "Internal Server Error"
            ));
        }
        die;
    case "GET":
        // $user = json_decode(file_get_contents('php://input'));
        // // $token = $user->token;
        // echo $user;exit;
        // $curtoken="sdfsd45trfgdtr34534rg237921#232jsdhcfs";
        // if($curtoken==$token){
            $json_data = array();
            if($totalRow=$objQuery->fetchResults("`unsubscribe`")){
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    $json_data[]=$fetchRow;
                }
                http_response_code(200);
                echo json_encode(array(
                    'data'=>$json_data,
                    'status' => 200, 
                    'message' => "Success"
                ));
                die;
            }else{
                http_response_code(500);
                echo json_encode(array(
                    'status' => 500, 
                    'message' => "Internal Server Error"
                ));
            }
            
        // }
    case "DELETE":

        $ids = json_decode(file_get_contents('php://input'));
        $arr = str_replace("-",",",$ids);
        // echo json_encode(array(
        //         'status' => 200, 
        //         'message' => "Deleted",
        //         'data'=>$arr
        //     ));
        //     exit;
         if ($objQuery->deleteRowArray("`unsubscribe`", "`id`","$arr")) {
            http_response_code(200);
            echo json_encode(array(
                'status' => 200, 
                'message' => "Deleted"
            ));
         }else{
            http_response_code(500);
            echo json_encode(array(
                'status' => 500, 
                'message' => "Internal Server Error"
            ));
     }
}
