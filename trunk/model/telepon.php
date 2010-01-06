<?php
function tlp_insert($kodeKaryawan, $tlp){
	$sql = "insert into telpon values ('" . $kodeKaryawan . "', '" .  $tlp . "')";	
	return mysql_query($sql);
}

function tlp_delete($id){
	$sql = "delete from telpon 
				where 
					KODE_KARYAWAN = '$id'";
	//NO_TELPON = '$id'
	return mysql_query($sql);
}

function tlp_load($karyID){
	$sql = "select * from telpon where KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);
}