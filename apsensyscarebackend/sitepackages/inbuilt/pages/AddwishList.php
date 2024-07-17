<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $productid = $user->productid;
        $userId = $user->userId;
        $Date = date("Y-m-d h:i:sa");
        if ($objQuery->insertData("`wishlist`", "`user_id`='" . $userId . "',`product_id`='" . $productid . "',`created_at`='" . $Date . "'")) {
            http_response_code(200);
        } else {
            http_response_code(500);
        }
}
