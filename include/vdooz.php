<?php
ob_start();
session_start();
date_default_timezone_set("Asia/Kolkata");
// if($_SERVER['SERVER_ADDR']=="127.0.0.1" or $_SERVER['SERVER_ADDR']=="::1")
$conn=new mysqli("localhost","admin","admin","shopping");

// else
// require_once("offset.php");

require_once('functions.php');

?>
