<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $addcategory = json_decode(file_get_contents('php://input'));
        print_r($addcategory);
        $catname = $addcategory->category_name;
        $caturl=$addcategory->category_url;
        $catimage = $addcategory->category_img;
        $cattitle = $addcategory->category_title;
        $catdesc=$addcategory->category_des;
        $topseller=$addcategory->topsellers;
        $topsellerdesc=$addcategory->topsellers_desc;
        // $create=$addcategory->created_at;
        $topproduct=$addcategory->top_product;
        $topproductid=$addcategory->top_product_id;
        $Date = date("Y-m-d h:i:s");
        if(isset($addcategory)&&isset($catname)&&isset($cattitle)&&isset($catimage)){
            if ($objQuery->fetchNumRow("`product_category`", "`category_name`='".$catname."' or `category_url`='".$caturl."' or `category_img`='".$catimage."' or `category_title`='" . $cattitle . "' or `category_des`='".$catdesc."' or `topsellers`='".$topseller."' or `topsellers_desc`='".$topsellerdesc."' or  `top_product`='".$topproduct."' or `top_product_id`='".$topproductid."'") > 0) {
                http_response_code(409);
                echo json_encode(array(
                    'status' => 409, 
                    'message' => "Category alredy exists"
                ));
            } else {
                $userId=$objQuery->generateUserID();
                if ($objQuery->insertData("`product_category`", "`category_name`='".$catname."', `category_url`='".$caturl."',`category_img`='".$catimage."',`category_title`='" . $cattitle . "',`category_des`='".$catdesc."',`topsellers`='".$topseller."',`topsellers_desc`='".$topsellerdesc."',`created_at`='".$Date."',`top_product`='".$topproduct."',`top_product_id`='" . $topproductid. "'")) {
                    http_response_code(200);
                    echo json_encode(array(
                        'status' => 200, // success or not?
                        'message' => "Category Added!!"
                    ));
                } else {
                    http_response_code(500);
                    echo json_encode(array(
                        'status' => 500, 
                        'message' => "Internal Server Error"
                    ));
                }
            }
        }else{
            http_response_code(500);
            echo json_encode(array(
            'status' => 500, 
                'message' => "Fields are important"
            ));
        }
    }
