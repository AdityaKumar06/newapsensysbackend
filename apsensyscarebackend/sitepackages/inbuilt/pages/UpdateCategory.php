<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $cat_desc = json_decode(file_get_contents('php://input'));
        // print_r($cat_desc);
        // die;
        $cat_id=$cat_desc->id;
        $catname = $cat_desc->category_name;
        $catUrl = $cat_desc->category_url;
        $cattitle = $cat_desc->category_title;
        $catdes = $cat_desc->category_des;
        if ($objQuery->updateRow("`product_category`", "`category_name`='" . $catname . "',`category_url`='" . $catUrl . "',`category_title`='" . $cattitle . "',`category_des`='" . $catdes . "'","`id`='$cat_id'")) {
           echo "true";
        } else {
            echo "false";
        }
}
