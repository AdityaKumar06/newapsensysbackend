<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $json_data = array();
        if($totalRow=$objQuery->fetchResults("product_entry")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[] = $fetchRow;
            }
        }else{
            echo "false";
        }
        echo json_encode(['details'=>$json_data]);
}
?>
