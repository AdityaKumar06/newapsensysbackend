<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        //print_r($user);
        $name = $user->name;
        $email = $user->email;
        $message = $user->message;
        $Date = date("Y-m-d h:i:sa");
        if ($objQuery->insertData("`contact`", "`name`='" . $name . "',`email`='" . $email . "',`message`='" . $message . "'")) {
             http_response_code(200);
        } else {
            http_response_code(500);
        }
}
