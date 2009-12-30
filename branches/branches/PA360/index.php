<?php 
include 'lib/sessionCheck.php';

if ($_COOKIE_DATA->logged){
	header("Location: /pa360/dashboard.php");
}
else{
	include 'view/login.php';
}