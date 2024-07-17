<?php

$method=$_SERVER['REQUEST_METHOD'];

switch($method){
    case "POST":
        $id=json_decode(file_get_contents('php://input')) ;
        $id=$id->userid;
        // echo $user;die;
        $json_data = array();
        $Ids=array();
        if($totalRow=$objQuery->fetchResult('`site_user`',"`userId`='$id'")){
            while($fetchRow= mysqli_fetch_assoc($totalRow))
            {
                $json_data[]=$fetchRow;
            }
        }else{
            echo "false";
            
        }
        echo json_encode(['CustomerEdit'=>$json_data]);
}
?>

