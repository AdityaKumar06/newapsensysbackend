<!-- For user forgot password step-2 -->


<?php
// 
$method = $_SERVER['REQUEST_METHOD'];
switch ($method) {
    case "POST":
        $passwordData = json_decode(file_get_contents('php://input'));
        
        // Extract data from the JSON object
        $otp = $passwordData->otp; 
        $password = $passwordData->password;
        $phone = $passwordData->phone;
        
        // Print or use the extracted data
        echo "OTP: $otp\n";
        echo "Password: $password\n";
        echo "Phone: $phone\n";
        // $totalRow=$objQuery->fetchValues("`otp`","`user_otp`","`phone_number`='".$phone."'");
        if($objQuery->fetchNumRow("`user_otp`", "`otp`='" . md5($otp) . "' AND `phone_number`='" . $phone . "'") == 1){
            $result = $objQuery->updateRow("`site_user`", "`password`='" . md5($password) . "'","`phone_number`='$phone'");
            if($result){
                if($objQuery->deleteRowArray("`user_otp`", "`phone_number`","$phone")){
                    http_response_code(200);
                    echo json_encode(array(
                        'status' => 200, 
                        'message' => "Deleted"
                    ));
                }

            }
        }else{
            echo 'wrong otp or phoneno';
        }
        // print_r($totalRow); die;

        // Your logic to handle the password update goes here
        // e.g., validate OTP, update password in the database, etc.

}
?>