<?php
function tlp_insert($kodeKaryawan, $tlp){
	$sql = "insert into telpon values ('" . $kodeKaryawan . "', '" .  $tlp . "')";	
	return mysql_query($sql);
}

function tlp_delete($tlpID, $karyID=false){
	$sql = "DELETE FROM telpon 
			WHERE No_Telpon='$tlpID' ";
	
	if ($karyID){
		$sql .= " AND KODE_KARYAWAN='$karyID'";
	}
	return mysql_query($sql);
}

function tlp_isExistID($tlpID){
	$sql = "select * from telpon where No_Telpon=$tlpID";
	$res = mysql_query($sql);
	while (mysql_fetch_assoc($res)){ return true; }
	return false;
}

function tlp_load($karyID){
	$sql = "select * from telpon where KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);
}