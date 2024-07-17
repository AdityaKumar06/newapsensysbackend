<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $json_data = array();
        $id=json_decode(file_get_contents('php://input')) ;
        if($totalRow=$objQuery->fetchResult("magnifying_img","`product_id`='".$id."'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[] = $fetchRow;
            }
        }else{
            echo "false";
        }
        echo json_encode(['images'=>$json_data]);
}
?>

