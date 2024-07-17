<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $id = json_decode(file_get_contents('php://input'));
        $id=$id->id;
        echo $id;
        if(isset($id)){
            
        
        
            if ($objQuery->deleteRow("`product`", "`id`='$id'")) {
                      if ($objQuery->deleteRow("`product_entry`", "`product_id`='$id'")) {
                    
                     http_response_code(200);
                   echo "true";
                    
                } else {
                     http_response_code(500);
                     echo "somthing went worng";
                    
                }
                
            } else {
                 http_response_code(500);
                 echo "somthing went worng";
                
            }
          
        }else{
            http_response_code(500);
             echo "somthing went worng";
            
        }
}
