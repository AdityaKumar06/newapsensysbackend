<?php
include_once('Config.php');
include CLASS_PATH .'Category.php';
include CLASS_PATH .'Connection.php';
include CLASS_PATH .'Query.php';
include CLASS_PATH .'Session.php';
$objSession = new Session();
$objConn	= new Connection(HOST_NAME, USER_NAME, PASSWORD, DB_NAME);
$objQuery 	= new Query();
$objCategory= new Category();
?>
