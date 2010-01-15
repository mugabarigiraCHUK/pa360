<?php
@include 'lib/config.php';

//read the cookie
$cooName = $config['cookie']['name'];
if (isset($_COOKIE[$cooName])) {
	//decrypt the cookie
	if ($config['cookie']['encrypt']){ 
		$coo = base64_decode($_COOKIE[$cooName]); 
	}
	$coo = json_decode($coo);
	$_LOGGED = $coo->logged;
    $_COOKIE_DATA = $coo;
}
else{
	include 'view/login.php';
	exit();
}