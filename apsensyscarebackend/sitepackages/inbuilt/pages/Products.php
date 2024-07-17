<?php

$method=$_SERVER['REQUEST_METHOD'];

// echo('hello');

switch($method){
    case "POST":
        $json_data = array();
        if($totalRow=$objQuery->getdefaultProducts()){
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