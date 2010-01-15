<?php
include_once 'config.php';

//prepare data cookie
$coo = "";
$cooName = $config['cookie']['name'];
$cooExp = $config['cookie']['expired'];
$cooPath = $config['cookie']['path'];
$cooDomain = $config['cookie']['domain'];

//encrypt the cookie
if ($config['cookie']['encrypt']){ $coo = base64_encode($coo); }

setcookie($cooName, $coo, $cooExp - time(), $cooPath, $cooDomain); 
header("Location: /pa360");