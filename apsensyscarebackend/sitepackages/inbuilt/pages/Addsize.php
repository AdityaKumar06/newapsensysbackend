<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $size_value = json_decode(file_get_contents('php://input'));
        if(isset($size_value)){
            $size = $size_value->size_value;
            if ($objQuery->insertData("`product_size`", "`size_value`='" . $size . "'")) {
                 http_response_code(200);
               
            } else {
                http_response_code(500);
              
            }
            
        }else
        {
             http_response_code(500);
             
                
            }
}
