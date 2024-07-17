<?php
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        $phone = $user->phone;
        // var_dump($user);
        // die();
        $json_data = array();

        if ($objQuery->fetchNumRow("`site_user`", "`phone_number`='" . $phone . "'") == 1) {

            // Authorisation details.
            $otp=mt_rand(100,9999);
            echo $otp;

            $mobile = '91'.$phone;
            $message = 'Hello';
            $apiKey = 'NjE3ODY5NmQ0ZDM5NGU2OTRmNjI0YzUxNTA0YzcyMzM=';
            $yourDiscountCode="10";
            
            // Message details
            $numbers = array($mobile);
            $sender = '600010';
            $objQuery->insertData("`user_otp`", "`phone_number`='".$phone."',`otp`='".md5($otp). "'");

            die;
            // echo $otp; die;
            // Dynamic template message with placeholder for variable
            $templateMessage = 'Hi there, thank you for sending your first test message from Textlocal. Get 20% off today with our code: '.$otp.'.';
            // echo  $templateMessage; 
             // Replace 'var' with your actual discount code variable
            
            // Encode message
            $message = rawurlencode($templateMessage);
            
            // $numbers = implode(',', $numbers);
            
            // Prepare data for POST request
            // $data = array(
            //     'apikey' => $apiKey,
            //     'numbers' => $numbers,
            //     'sender' => $sender,
            //     'message' => $message,
            //     'template_id' => '1107161517879065578' // Specify the ID or name of your dynamic template
            // );
            
            // Send the POST request with cURL
            // $ch = curl_init('https://api.textlocal.in/send/');
            // curl_setopt($ch, CURLOPT_POST, true);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $response = curl_exec($ch);
            
            // Check for errors
            if ($response === false) {
                echo 'Curl error: ' . curl_error($ch);
            } else {
                // Process your response here
                echo $response;
            }
            
            http_response_code(200);
            echo json_encode(array(
                'status' => 200, // success or not?
                'message' => "Reset password link has been send to your email Id"
            ));
        } else {
            http_response_code(400);
            echo json_encode(array(
                'status' => 400,
                'message' => "User not found! please try Again"
            ));
        }
}
// session_destroy();
