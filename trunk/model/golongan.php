<?php

function golongan_select_exclude($exclude=false){
	$sql = "select * from data_golongan ";
	if ($exclude){
		if (is_array($exclude)){
			$count = count($exclude);
			foreach($exclude as $ex){
				$z++;
				if ($ex=="") continue;
				$exc .= " ID_GOLONGAN != '$ex' ";
				$exc .= $z<$count? " AND " : "";
			}
			
			if ($exc !='') $exc = " where " .$exc;
		}
		else {
			if ($exc !='') $exc .= " where ID_GOLONGAN != '$exclude' ";
		}
	}
	$sql .= $exc;
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function golongan_select($key=false){
	$sql = "select * from data_golongan ";
	if ($key){
		$sql .= " where 
				ID_GOLONGAN like '%$key%' OR
				NAMA_GOLONGAN like '%$key%' ";
	}
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function golongan_load($id){
	$sql = "select * from data_golongan
			where ID_GOLONGAN = '$id'";
	return mysql_query($sql);
}

function golongan_isExistID($id){
	$sql = "select * from data_golongan
			where ID_GOLONGAN = '$id'";
	
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc($result);
	if ($res['ID_GOLONGAN'] === $id) return true;
	return false;
}

/**
 * insert data golongan
 * @param $gol_id (string) - kode golongan
 * @param $golNama (string) - nama golongan
 */
function golongan_add($gol_id, $golNama){
	$sql = "insert into data_golongan ".
			"values ('$gol_id','$golNama')";
	return mysql_query($sql);
}

/**
 * update data golongan
 * @param unknown_type $gol_id
 * @param unknown_type $golNama
 */
function golongan_update($gol_id, $golNama){
	$sql = "update data_golongan ".
			"set NAMA_GOLONGAN = '$golNama'
			where ID_GOLONGAN='$gol_id'";
	return mysql_query($sql);
}

/**
 * delete data golongan
 * @param $gol_id (string) - kode golongan
 */
function golongan_delete($gol_id){
	$sql = "delete from data_golongan ".
			"where ID_GOLONGAN='$gol_id'";
	return mysql_query($sql);
}