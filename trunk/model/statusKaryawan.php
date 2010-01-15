<?php

function stskary_select($key=FALSE){
	$sql = "select * from status_karyawan";
	if ($key){
		$sql .= " where 
					ID_STATUS_KARYAWAN like '%$key%' OR 
					NAMA_STATUS like '%$key%'";
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function stskary_load($id){
	$sql = "select * from status_karyawan
			where ID_STATUS_KARYAWAN = '$id'";
	return mysql_query($sql);
}

function stskary_isExistID($id){
	$sql = "select * from status_karyawan
			where ID_STATUS_KARYAWAN = '$id'";
	
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc($result);
	if ($result['ID_STATUS_KARYAWAN'] === $id) return true;
	return false;
}

/**
 * @param $divID (string) - kode divisi
 * @param $depID (string) - kode departemen
 * @param $divNama (string) - nama divisi
 */
function stskary_add($stsID, $nama){
	$sql = "insert into status_karyawan ".
			"values ('$stsID','$nama')";
	return mysql_query($sql);
}

function stskary_update($stsID, $nama){
	$sql = "update status_karyawan ".
			"set NAMA_STATUS = '$nama' 
			where ID_STATUS_KARYAWAN='$stsID'";
	return mysql_query($sql);
}

/**
 * delete data divisi
 * @param $divID (string) - kode divisi
 */
function stskary_delete($stsID){
	$sql = "delete from status_karyawan ".
			"where ID_STATUS_KARYAWAN='$stsID'";
	return mysql_query($sql);
}