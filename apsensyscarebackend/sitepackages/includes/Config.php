<?php
##------------------------------ Site Path Define, Start ---------------------------------##
define("SERVER_PATH", "http://".$_SERVER['HTTP_HOST']."/apsensyscarebackend");
define("SERVER_ROOT",$_SERVER['DOCUMENT_ROOT']."/apsensyscarebackend");
define("FILE_UPLOAD_PATH", SERVER_ROOT."upload/");
define("INCLUDE_PATH", SERVER_ROOT."/sitepackages/includes/");
define("CLASS_PATH", SERVER_ROOT."/sitepackages/classes/");
define('IMAGE_PATH',SERVER_PATH.'images/');
define('ADMIN_PATH',SERVER_ROOT.'admin/'); 
define('ADMIN_SERVER_PATH' , SERVER_PATH.'admin/');

##------------------------------ Site Path Define, End -----------------------------------##
##------------------------------ DB Information Define, Start ----------------------------##
define("HOST_NAME", "localhost");
define("USER_NAME", "root");
define("PASSWORD", ""); 
define("DB_NAME", "apsensyscare");
##------------------------------ DB Information Define, End ------------------------------##
##------------------------------ Error Message Define, Start -----------------------------##
define("ERR_CONNECT_SERVER", "Unable to connect to mysql server.");
define("ERR_NO_DATABASE", "Unable to select database.");	
define("ERR_INSERT_DATA", "Unable to insert data.");
define("SUCC_USER_REGISTER", "Member created successfully.Kindly wait for approvel");
define("SUCC_COMPANY_REGISTER", "Company created successfully.");
define("SUCC_INSERT_DATA", "Data inserted.");	
define("SUCC_UPDATE_DATA", "Data updated.");	
define("ERR_UPDATE_DATA", "Unable to update data.");
define("SUCC_DELETE", "Record deleted.");
define("ERR_DELETE", "Unable to deleted.");		
define("ERR_LOGIN", "User Id or Password did not match.");
define("SEARCH_RESULT", "Record not found.");
define("SUCC_PASSWORD", "Password has been changed successfully.");
define("ERR_PASSWORD", "Invalid Password.");
define("SUCC_SEARCH_RESULT", "Search Result.");
define("ERR_IMAGE_EXT", "Image can only be with jpeg, jpg, png or gif extention. Please try again!");
define("ERR_UPLOADING", "Error while uploading file. Please try again!");
define("SUCC_UPLOAD", "Image has been uploaded.");
define("SUCC_EMAIL_VERIFY", "You have been successfully verified.");
define("ERR_EMAIL_VERIFY", "Your Confirmation code is invalid.");
##------------------------------ Error Message Define, End -------------------------------##

##------------------------------ Time Zone Define, Start ---------------------------------##
date_default_timezone_set('Asia/Calcutta'); 
##------------------------------ Time Zone Define, End -----------------------------------##
?>