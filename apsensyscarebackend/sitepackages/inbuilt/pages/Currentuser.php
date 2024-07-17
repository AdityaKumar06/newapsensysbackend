<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $login_token = $user->refesstoken;
        // echo $login_token;
        $Date = date("Y-m-d h:i:sa");
        $json_data = array();
        if ($objQuery->fetchNumRow("`site_user`", "`login_token`='" . $login_token . "' ") == 1) {
            $token = $objQuery->getRandomHashCode();
            $loginToken = bin2hex(random_bytes(32));
            if ($totalRow = $objQuery->fetchSelectRows("`id`,`userId`,`f_name`,`login_token`,`phone_number`", "`site_user`", "`login_token`='" . $login_token . "' ")) {
                while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                    $json_data[] = $fetchRow;
                }
            }
            if ($objQuery->updateRow("`site_user`", "`login_token`='$loginToken', `updated_at`='$Date'", "`login_token`='" . $loginToken . "' ")) {
                setcookie('ACCESSTOKEN', $token, time() + 300, "/");
                setcookie('REFRESSTOKEN', $token, time() + (86400 * 30), "/");
                http_response_code(200);
                echo json_encode(['details' => $json_data, 'token' => $loginToken]);
            }
        } else {
            http_response_code(400);
            echo json_encode(array(
                'status' => 400,
                'message' => "User not found! please try Again"
            ));
        }
}
