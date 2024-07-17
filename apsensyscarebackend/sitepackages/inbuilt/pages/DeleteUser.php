<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $userid = json_decode(file_get_contents('php://input'));
        $userID = $userid->userId;
        if(isset($userID)){
            if ($objQuery->deleteRow("`site_user`", "`userId`='$userID'")) {
                 http_response_code(200);
               echo "true";
                
            } else {
                 http_response_code(500);
                 echo "somthing went worng";
                
            }
        }else{
            http_response_code(500);
             echo "somthing went worng";
            
        }
        
}
