<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $id=json_decode(file_get_contents('php://input')) ;
        // echo $user;die;
        $json_data = array();
        $Ids=array();
        if($totalRow=$objQuery->productIdwithSize($id)){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            die;
        }
        echo json_encode(['productsizes'=>$json_data]);
}
?>

