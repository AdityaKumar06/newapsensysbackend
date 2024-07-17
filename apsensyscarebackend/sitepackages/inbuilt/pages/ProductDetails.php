<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $productId=json_decode(file_get_contents('php://input')) ;
        
        $json_data = array();
        $Ids=array();
        $totalRow=$objQuery->fetchResult("`product`","`id`='".$productId."'");
        if($totalRow){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['productdetails'=>$json_data]);
}
