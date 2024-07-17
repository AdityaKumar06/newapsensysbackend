<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $catId=json_decode(file_get_contents('php://input')) ;
        $json_data = array();
        if($totalRow=$objQuery->fetchResult("`product`","`category_id`='".$catId."'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[] = $fetchRow;
            }
        }else{
            echo "false";
        }
        echo json_encode(['product'=>$json_data]);
}
?>

