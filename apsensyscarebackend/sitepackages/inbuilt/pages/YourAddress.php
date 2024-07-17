<?php

$method=$_SERVER['REQUEST_METHOD'];
// $user_id=$_SESSION["___user"];
// echo $user_id;
switch($method){
    case "POST":
        $staus=json_decode(file_get_contents('php://input')) ;
        $id= $staus->user_id;
        // echo($staus);
        $json_data = array();
        if(isset($staus)){
            
            if($totalRow=$objQuery->Youraddress($id)){ 
                
                while($fetchRow= mysqli_fetch_assoc($totalRow))
                {
                    // print_r($fetchRow); die;
                
                    $json_data[] = $fetchRow;
                }
                http_response_code(200);
                echo json_encode(['Youraddress'=>$json_data]);
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

