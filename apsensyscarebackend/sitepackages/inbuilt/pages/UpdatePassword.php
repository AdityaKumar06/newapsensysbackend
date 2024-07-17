<?php
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST":
        $password = json_decode(file_get_contents('php://input'));
        //  $password=$password->userId;
        //  $password=$password->password;
       
        // print_r($password);
        // die;
        echo "script";
        $otp=$password->otp;
        echo $otp; 
        $password = $password->password;
        echo $password; 
        // $phone = $password->phone;
        // echo $phone; 
        // echo json_encode([$password->phone]);
        die;
        // $result = $objQuery->updateRow("`site_user`", "`password`='" . md5($password) . "'","`userId`='$user_id'");
        // print_r($result );
        
        if ($totalRow = $objQuery->fetchResult("`user_otp`", "`phone_number`='" . $phone . "' AND `created_at`='$tempDate' AND `pincode`='". $pincode."'"))
        while ($fetchRow = mysqli_fetch_assoc($totalRow)) {
    
    
        }


        if ($objQuery->updateRow("`site_user`", "`password`='" . md5($password) . "'","`userId`='$user_id'")) {
           echo "true";
        } else {
            echo "false";
        }
}
