<?php

function kripen_select($key=false){
	$sql = "select * from kriteria_penilaian";
	if ($key){
		$sql .= " where 
					ID_KRITERIA like '%$key%' OR
					NAMA_KRITERIA like '%$key%' OR
					DESKRIPSI like '%$key%'";
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function kripen_load($id){
	$sql = "select * from kriteria_penilaian
			where ID_KRITERIA = '$id'";
	return mysql_query($sql);
}

function kripen_isExistID($id){
	$result = kripen_load($id);
	$result = mysql_fetch_assoc($result);
	if ($result['ID_KRITERIA'] === $id) return true;
	return false;
}

/**
 * insert data divisi
 * @param $divID (string) - kode divisi
 * @param $depID (string) - kode departemen
 * @param $divNama (string) - nama divisi
 */
function kripen_add($kripenID, $nama, $desc, $standart){
	$sql = "insert into kriteria_penilaian ".
			"values ('$kripenID', '$nama', '$desc', '$standart')";
	return mysql_query($sql);
}

function kripen_update($kripenID, $nama, $desc, $standart){
	$sql = "update kriteria_penilaian ".
			"set NAMA_KRITERIA = '$nama',  
				DESKRIPSI = '$desc',
				STANDART = $standart
			where ID_KRITERIA='$kripenID'";
	return mysql_query($sql);
}

/**
 * delete data divisi
 * @param $divID (string) - kode divisi
 */
function kripen_delete($kripenID){
	$sql = "delete from kriteria_penilaian ".
			"where ID_KRITERIA='$kripenID'";
	return mysql_query($sql);
}