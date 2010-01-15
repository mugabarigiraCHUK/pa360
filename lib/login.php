<?php
include_once 'config.php';
include_once 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$asAdmin = $_POST['asAdmin'];

$sql = "select * from data_user
		where user_nama='$username' AND  
			user_password=md5('$password')";

//check login, simply loop it
$log = false;
$result = mysql_query($sql);
while ($row = mysql_fetch_assoc($result)){
	$log = $row;
}

$redirect = '../';

if ($log) {
	//create cookie
	$data= array(
		'username' 	=> $username,
		'alias' 	=> md5($username),
		'type' 		=> $log['user_tipe'],
		'logged' 	=> TRUE,
		'asAdmin'	=> $asAdmin
	);
	
	//prepare data cookie
	$coo = json_encode($data);
	$cooName = $config['cookie']['name'];
	$cooExp = $config['cookie']['expired'];
	$cooPath = $config['cookie']['path'];
	$cooDomain = $config['cookie']['domain'];
	
	//encrypt the cookie
	if ($config['cookie']['encrypt']){ $coo = base64_encode($coo); }
	
	setcookie($cooName, $coo, $cooExp + time(), $cooPath, $cooDomain); 
}

//determine where redirected
header("Location: $redirect");
