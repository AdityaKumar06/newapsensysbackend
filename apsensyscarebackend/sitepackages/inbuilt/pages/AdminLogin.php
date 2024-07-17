<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        // print_r($user);die;
        $password = $user->password;
        $email = $user->email;
        $Date = date("Y-m-d h:i:sa");
        $json_data = array();
        if ($objQuery->fetchNumRow("`site_user`", "`password`='" . md5($password) . "' AND `email_address`='" . rawurlencode($email) . "' AND `type`='admin'") == 1) {
            $token = $objQuery->getRandomHashCode();
            $loginToken = bin2hex(random_bytes(32));
            if ($objQuery->updateRow("`site_user`", "`login_token`='$loginToken'", "`email_address`='" . rawurlencode($email) . "' AND `password`='" . md5($password) . "'")) {
                if($totalRow = $objQuery->fetchSelectRows("`id`,`userId`,`f_name`,`login_token`", "`site_user`", "`email_address`='" . rawurlencode($email) . "' AND `password`='" . md5($password) . "'"))
                {
                    while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                        $json_data[] = $fetchRow;
                    }
                    setcookie('ACCESSTOKENADMIN', $token, time() + 300, "/");
                    setcookie('REFRESSTOKENADMIN', $token, time() + (86400 * 30), "/");
                    http_response_code(200);
                    echo json_encode(['details' => $json_data,'cookies'=>$token,'status' => 200]);
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
