<?php 
include 'lib/sessionCheck.php';

if ($_COOKIE_DATA->logged){
	header("Location: ./dashboard.php");
}
else{
	include 'view/login.php';
}