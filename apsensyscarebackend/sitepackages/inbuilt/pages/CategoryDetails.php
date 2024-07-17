<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $category_id=json_decode(file_get_contents('php://input')) ;
        // echo($category_id);
        // die;
        $json_data = array();
        $Ids=array();
        $totalRow=$objQuery->fetchResult("`product_category`","`id`='".$category_id."'");
        if($totalRow){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['categorydetails'=>$json_data]);
}
