<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $user = json_decode(file_get_contents('php://input'));
        //print_r($user);
        
        $topBrandLink = $user->top_brand_link;
        $b_name = $user->brand_name;
        $featuredbrandimg = $user->featured_brand_image;
        $featuredBrandLink = $user->featured_brand_link;
        $topBrandImage = $user->top_brand_image;
        $address_type = $user->address_type;
        $Date = date("Y-m-d h:i:sa");
        $tempDate=$Date;
        $user_id=$user->user;
        $isDefault='yes';
        if ($objQuery->insertData("`brands`", "`brand_name`='" . $b_name . "',`featured_brand`='" . $featuredbrandimg . "',`featured_brand_link`='" . $featuredBrandLink . "',`top_brand`='" . $topBrandImage . "',`top_brand_link`='" . $topBrandLink . "'")) {
        } else {
             http_response_code(500);
        }
}
