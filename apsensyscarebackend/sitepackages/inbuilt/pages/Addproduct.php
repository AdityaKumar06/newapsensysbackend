<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $details = json_decode(file_get_contents('php://input'));
        
       
         $product=$details->product;
         $image=$details->Image;
         
         $product_brand_name =  $product->brand_name;
         
        
        $pid = $product->product;
       
        $categoryid = $product->category_id;
        $name = $product->name;
        $sname = $product->short_name;
        $keyword = $product->search_keywords;
        $product_url = $product->product_url;
        $default_price = $product->default_price;
        $default_size = $product->default_size;
        $description = $product->description;
        $long_description = $product->long_description;
        $product_image=$product->product_image;
        $stok_quntity = $product->stock_qty;

        $result = $objQuery->insertData("`product`", "`brand_name`='" . $product_brand_name . "',`category_id`='" . $categoryid . "',`name`='" . $name . "',`short_name`='" . $sname . "',`search_keywords`='" . $keyword . "',`product_url`='" . $product_url . "',`default_price`='" . $default_price . "',`default_size`='" . $default_size . "',`description`='" . $description . "',`long_description`='" . $long_description . "',`product_image`='".$product_image."' ","`id`='$pid'");
        if ($result ==  1  ) {
            $response =$objQuery->productdata();
            // print_r($response);
            $row = $response->fetch_object();
            $product_id =$row->id;
            $size_id = $row->size_id;
            $default_price = $row->default_price;
            $result1 = $objQuery->insertData("`product_entry`","`product_id`='". $product_id ."',`price`='". $default_price ."',`size_id`='".$size_id."',`stock_qty`='".$stok_quntity."'");
            // print_r($result1);
            // die();
            if($result1 == 1){
                 $image_100 =$image->largeImg;
 
                 $image_230 =$image->mediumImg;

                 $image_1200 =$image->smallImg;
                 $result2 = $objQuery->insertData("`magnifying_img`","`product_id`='". $product_id  ."',`image_100`='". $image_100  ."',`image_230`='". $image_230 ."',`image_1200`='".$image_1200."'");
                 
            }
            if($result2 == 1){
                http_response_code(200);
                echo  "true";
            }
            
        } else {
             http_response_code(500);
             echo "something went wrong";
        }
}
