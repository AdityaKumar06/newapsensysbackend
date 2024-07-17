<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        // echo"hello";die;
        $json_data = array();
        if($totalRow=$objQuery->getpendingOrder()){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['order'=>$json_data]);
}
?>

