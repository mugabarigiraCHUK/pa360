<?php

function divisi_select($key=false){
	$sql = "select * from data_divisi ";
	if ($key){
		$sql .= " where 
				NAMA_DIVISI like '%$key%' OR 
				data_divisi.ID_DIVISI like '%$key%' ";
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function divisi_load($id){
	$sql = "select * from data_divisi where ID_DIVISI = '$id'";
	return mysql_query($sql);
}

function divisi_isExistID($id){
	$result = divisi_load($id);
	$result = mysql_fetch_assoc($result);
	if ($result['ID_DIVISI'] == $id) return true;
	return false;
}

/**
 * insert data divisi
 * @param $divID (string) - kode divisi
 * @param $depID (string) - kode departemen
 * @param $divNama (string) - nama divisi
 */
function divisi_add($divID, $divNama){
	$sql = "insert into data_divisi ".
			"values ('$divID', '$divNama')";
	return mysql_query($sql);
}

function divisi_update($divID, $divNama){
	$sql = "update data_divisi ".
			"set NAMA_DIVISI = '$divNama'
			where ID_DIVISI='$divID'";
	return mysql_query($sql);
}

/**
 * delete data divisi
 * @param $divID (string) - kode divisi
 */
function divisi_delete($divID){
	$sql = "delete from data_divisi ".
			"where ID_DIVISI='$divID'";
	return mysql_query($sql);
}