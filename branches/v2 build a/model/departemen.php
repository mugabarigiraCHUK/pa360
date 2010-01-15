<?php

function departemen_select($key=false, $orderBy=false){
	$sql = "select * from data_department ";
	if ($key){
		$sql .= "where 
				ID_DEPARTMENT like '%$key%' OR 
				NAMA_DEPARTMENT like '%$key%'";
	}
	if ($orderBy){
		$sql.= "ORDER BY ".$orderBy;
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function departemen_load($id){
	$sql = "select * from data_department
			where ID_DEPARTMENT = '$id'";
	return mysql_query($sql);
}

function departemen_isExistID($id){
	$sql = "select * from data_department
			where ID_DEPARTMENT = '$id'";
	
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc($result);
	if ($res['ID_DEPARTMENT'] === $id) return true;
	return false;
}

/**
 * insert data departemen
 * @param $dep_id (string) - kode departemen
 * @param $depNama (string) - nama departemen
 */
function departemen_add($dep_id, $depNama){
	$sql = "insert into data_department ".
			"values ('$dep_id','$depNama')";
	return mysql_query($sql);
}

/**
 * update data departemen
 * @param unknown_type $dep_id
 * @param unknown_type $depNama
 */
function departemen_update($dep_id, $depNama){
	$sql = "update data_department ".
			"set NAMA_DEPARTMENT = '$depNama'
			where ID_DEPARTMENT='$dep_id'";
	return mysql_query($sql);
}

/**
 * delete data departemen
 * @param $dep_id (string) - kode departemen
 */
function departemen_delete($dep_id){
	$sql = "delete from data_department ".
			"where ID_DEPARTMENT='$dep_id'";
	return mysql_query($sql);
}