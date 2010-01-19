<?php
function user_isExist($karyID){
	$res = user_load($karyID);
	while ($row = mysql_fetch_assoc($res)){ return true; }
	return false;
}

function user_load($karyID){
	return mysql_query("SELECT * FROM data_user WHERE user_nama='$karyID'");
}

function user_insert($karyID, $pass, $prev=2){
	$sql = "INSERT INTO data_user VALUES('$karyID', '$pass', '$prev')";
	return mysql_query($sql);
}

function user_role($karyID){
	if (! user_isExist($karyID)) return false;
	$res = mysql_fetch_assoc(user_load($karyID));
	return $res['user_tipe']; 
}

function user_isRoleAdmin($karyID, $adminRole=1){
	return user_role($karyID)==$adminRole;
}

function user_update($karyID, $pass, $prev=2){
	$sql = "UPDATE data_user SET user_password='$pass', user_tipe='$prev'
			WHERE user_nama='$karyID'";
	return mysql_query($sql);
}