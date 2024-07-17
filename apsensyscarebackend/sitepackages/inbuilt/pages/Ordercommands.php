<?php
session_start();
$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $staus=json_decode(file_get_contents('php://input')) ;
        $staus= $staus->status;
        // echo($staus);
        $json_data = array();
        if(isset($staus)){
            
            if($totalRow=$objQuery->fullorderDetails($staus)){
                
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    // print_r($fetchRow); die;
                
                    $json_data[] = $fetchRow;
                }
                http_response_code(200);
                echo json_encode(['orderdata'=>$json_data]);
            }else{
               
                echo "false";
                die;
            }
            
        }else{
            echo "false";
                die;
            
        }
        break;
}
?>

