<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $details = json_decode(file_get_contents('php://input'));
        // print_r( $details->category_id);
        // die;
        $bname = $details->brand_name;
        $pid = $details->id;
        $categoryid = $details->category_id;
        $name = $details->name;
        $sname = $details->short_name;
        $keyword = $details->search_keywords;
        $product_url = $details->product_url;
        $default_price = $details->default_price;
        $default_size = $details->default_size;
        $description = $details->description;
        $long_description = $details->long_description;
        $product_image=$details->product_image;
        if ($objQuery->updateRow("`product`", "`brand_name`='" . $bname . "',`category_id`='" . $categoryid . "',`name`='" . $name . "',`short_name`='" . $sname . "',`search_keywords`='" . $keyword . "',`product_url`='" . $product_url . "',`default_price`='" . $default_price . "',`default_size`='" . $default_size . "',`description`='" . $description . "',`long_description`='" . $long_description . "',`product_image`='".$product_image."' ","`id`='$pid'")) {
           echo "true";
        } else {
            echo "false";
        }
}
