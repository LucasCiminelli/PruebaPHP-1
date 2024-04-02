<?php 

include("./templates/header.php");

session_start();
session_destroy();
header("location:".$url_base."./login.php");


?>