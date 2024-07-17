<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        
        $password = $user->password;
        $phone = $user->phone;
        // echo $phone; die;
        $Date = date("Y-m-d h:i:sa");
        $json_data = array();
        if ($objQuery->fetchNumRow("`site_user`", "`password`='" . md5($password) . "' AND `phone_number`='" . $phone . "' OR `email_address`='" . rawurlencode($phone) . "'") == 1) {
            $token = $objQuery->getRandomHashCode();
            $loginToken = bin2hex(random_bytes(32));
            if(is_numeric($phone)){
                if ($objQuery->updateRow("`site_user`", "`login_token`='$loginToken', `updated_at`='$Date'", "`phone_number`='" . $phone . "' AND `password`='" . md5($password) . "'")) {
                    if($totalRow = $objQuery->fetchSelectRows("`id`,`userId`,`f_name`,`login_token`", "`site_user`", "`phone_number`='" . $phone . "' AND `password`='" . md5($password) . "'"))
                    {
                        while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                            $json_data[] = $fetchRow;
                        }
                        setcookie('ACCESSTOKEN', $token, time() + 300, "/");
                        setcookie('REFRESSTOKEN', $token, time() + (86400 * 30), "/");
                        http_response_code(200);
                        echo json_encode(['details' => $json_data,'token'=> $loginToken]);
                    }
                }
            }else{
                if ($objQuery->updateRow("`site_user`", "`login_token`='$loginToken', `updated_at`='$Date'", "`email_address`='" . rawurlencode($phone) . "' AND `password`='" . md5($password) . "'")) {
                    if($totalRow = $objQuery->fetchSelectRows("`id`,`userId`,`f_name`,`login_token`", "`site_user`", "`email_address`='" . rawurlencode($phone) . "' AND `password`='" . md5($password) . "'"))
                    {
                        while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                            $json_data[] = $fetchRow;
                        }
                        setcookie('ACCESSTOKEN', $token, time() + 300, "/");
                        setcookie('REFRESSTOKEN', $token, time() + (86400 * 30), "/");
                        http_response_code(200);
                        echo json_encode(['details' => $json_data,'token'=> $loginToken]);
                    }
                }
            }

        } else {
            http_response_code(400);
            echo json_encode(array(
                'status' => 400,
                'message' => "User not found! please try Again"
            ));
        }
}
