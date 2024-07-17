<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        //print_r($user);
        $area = $user->area;
        $city = $user->city;
        $email = $user->email;
        $house = $user->house;
        $name = $user->name;
        $phone = $user->phone;
        $pincode = $user->pincode;
        $state = $user->state;
        $address_type = $user->address_type;
        $Date = date("Y-m-d h:i:sa");
        $tempDate=$Date;
        $user_id=$user->user;
        $isDefault='yes';
        if ($objQuery->insertData("`address`", "`name`='" . $name . "',`contact`='" . $phone . "',`address_type`='" . $address_type . "',`pincode`='" . $pincode . "',`city`='" . $city . "',`state`='" . $state . "',`house_flat_office`='" . $house . "',`area_landmark`='" . $area . "',`email`='" . $email . "',`created_at`='$tempDate'")) {
            if ($totalRow = $objQuery->fetchResult("`address`", "`contact`='" . $phone . "' AND `created_at`='$tempDate' AND `pincode`='". $pincode."'")) {
                while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
                    if ($objQuery->insertData("`user_address`", "`user_id`='" . $user_id . "',`address_id`='" . $fetchRow['id'] . "',`is_default`='" . $isDefault . "',`created_at`='$Date'")) {
                        http_response_code(200);
                    }
                }
            }
        } else {
             http_response_code(500);
        }
}
