<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "POST":
        $id = json_decode(file_get_contents('php://input'));
        // $Date = date("Y-m-d h:i:sa");
        if ($objQuery->deleteRow("`product_entry`", "`id`='$id'")) {
            echo "true";
        } else {
            echo "false";
        }
}
