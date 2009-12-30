<?php
include 'Config.php';
include 'DB.php';
include 'lib/util/date.php';

/**
 * config global
 * @var array (mixed)
 */
$_CONFIG = $config;


/**
 * Database Connection
 * @var php connection link
 */
$_CON = db_connect(
	$config['db']['host'],
	$config['db']['username'], 
	$config['db']['password']);