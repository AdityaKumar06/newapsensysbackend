<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $password = json_decode(file_get_contents('php://input'));
        //  $password=$password->userId;
        //  $password=$password->password;
       
        // print_r($password);
        // die;
        
        $user_id=$password->userId;
        $password = $password->password;
        $result = $objQuery->updateRow("`site_user`", "`password`='" . md5($password) . "'","`userId`='$user_id'");
        // print_r($result );
        
       
        if ($objQuery->updateRow("`site_user`", "`password`='" . md5($password) . "'","`userId`='$user_id'")) {
           echo "true";
        } else {
            echo "false";
        }
}
