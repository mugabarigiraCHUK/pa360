<?php

/************************
 * DB Bootstrap
 *************************/

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

mysql_select_db($config['db']['database']);
	
/**********************************
 * FUNCTION
 ***********************************/
	
/**
 * connect
 * @param unknown_type $host
 * @param unknown_type $user
 * @param unknown_type $passwd
 */

function db_connect($host, $user, $passwd){
	$con = mysql_pconnect($host, $user, $passwd);
	return $con;
}