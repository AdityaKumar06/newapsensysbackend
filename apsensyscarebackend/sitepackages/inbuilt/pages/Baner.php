<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $json_data = array();
        if($totalRow=$objQuery->fetchResults("banners")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[] = $fetchRow;
            }
        }else{
            http_response_code(500);
        }
        echo json_encode(['banner'=>$json_data]);
}
?>

