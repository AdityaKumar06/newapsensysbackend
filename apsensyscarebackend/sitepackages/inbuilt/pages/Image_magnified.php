<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $images = json_decode(file_get_contents('php://input'));
        // print_r($images);
        // die;
        $product_id=$images->product_id;
        $image_100 = $images->image_100;
        $image_230 = $images->image_230;
        $image_1200 = $images->image_1200;
       
        if ($objQuery->updateRow("`magnifying_img`", "`image_100`='" . $image_100 . "'","`image_230`='" . $image_230 . "'","`image_1200`='" . $image_1200 . "'","`product_id`='$product_id'")) {
           echo "true";
        } else {
            echo "false";
        }
}
