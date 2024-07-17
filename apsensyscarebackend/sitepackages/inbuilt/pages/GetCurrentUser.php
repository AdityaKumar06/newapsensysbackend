<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $AccessToken = $user->login_token;
        $phone = $user->phone;
        $Date = date("Y-m-d h:i:sa");
        $json_data = array();
        if ($objQuery->fetchNumRow("`site_user`", "`login_token`='" . $AccessToken . "'") == 1) {
            $token = $objQuery->getRandomHashCode();
            $loginToken = bin2hex(random_bytes(32));
            if ($objQuery->updateRow("`site_user`", "`login_token`='$loginToken'", "`login_token`='" . $AccessToken . "'")) {
                if($totalRow = $objQuery->fetchSelectRows("`user_id`,`f_name`,`login_token`", "`site_user`", "`phone_number`='" . $phone . "' AND `password`='" . md5($password) . "'"))
                {
                    while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                        $json_data[] = $fetchRow;
                    }
                    setcookie('ACCESSTOKEN', $token, time() + 300, "/");
                    setcookie('REFRESSTOKEN', $loginToken, time() + (86400 * 30), "/");
                    http_response_code(200);
                    echo json_encode(['details' => $json_data]);
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
