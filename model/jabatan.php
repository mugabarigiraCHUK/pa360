<?php

function jbt_select($key=false){
	$sql = "select * from data_jabatan ";
	if ($key){
		$sql .= " where
					ID_JABATAN like '%$key%' OR
					NAMA_JABATAN like '%$key%' OR
					LEVEL_JABATAN like '%$key%'";
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function jbt_load($id){ 
	$sql = "select * from data_jabatan where ID_JABATAN='$id'";
	return mysql_query($sql);
}

/**
 * insert data jabatan
 * @param $id (string) - kode/id jabatan
 * @param $nama (string) - nama 
 * @param $level (string) - level 1/2/3/4
 */
function jbt_insert($id, $nama, $level){
	$sql = "insert into data_jabatan ". 
			"values ('$id','$nama','$level')";
	
	$result = mysql_query($sql);
	return $result;
}

function jbt_update($id, $nama, $level){
	$sql = "update data_jabatan set NAMA_JABATAN='$nama', LEVEL_JABATAN='$level' ". 
			"where ID_JABATAN='$id'";
	
	$result = mysql_query($sql);
	return $result;
}

/**
 * delete data jabatan
 * @param $id (String) - kode jabatan
 */
function jbt_delete($id){
	$sql = "delete from data_jabatan ". 
			"where ID_JABATAN='$id'";
	
	$result = mysql_query($sql);
	return $result;
}