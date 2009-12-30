<?php

function debot_select($nilai=false, $dekripenID=false, $key=false, $orderby=false){
	$sql = "select
				a.ID_DETAIL_KRITERIA,
				b.NAMA_DETAIL_KRITERIA,
				a.DESKRIPSI,
				a.NILAI
			from 
				deskripsi_bobot as a, 
				detail_kriteria as b 
			where a.ID_DETAIL_KRITERIA = b.ID_DETAIL_KRITERIA ";
	
	if ($dekripenID){
		$sql .= " AND ";
		$sql .= "a.ID_DETAIL_KRITERIA = '$dekripenID' ";
	}
	
	if ($nilai){
		$sql .= " AND ";
		$sql .= "a.NILAI = $nilai ";
	}
	
	if ($key){
		$sql .= " AND ";
		$sql .= " (a.ID_DETAIL_KRITERIA like '%$key%' OR
				  b.NAMA_DETAIL_KRITERIA like '%$key%' OR
				  a.DESKRIPSI like '%$key%' OR
				  a.NILAI like '%$key%')";
	}
	
	if ($orderby) $sql .= " ORDER BY ".$orderby;
			
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function debot_load($nilai, $dekripenID){
	return debot_select($nilai, $dekripenID);
}

function debot_isExistID($id, $dekripenID){
	$result = debot_load($id, $dekripenID);
	$result = mysql_fetch_assoc($result);
	if ($result['NILAI'] === $id) return true;
	return false;
}

/**
 * 
 * @param $debotID (string) - detail bobot id
 * @param $dekripenID (string) - detail kriteria penilaian
 * @param $desc (string) - deskripsi bobot
 * @param $nilai (int) - nilai
 */
function debot_add($nilai, $dekripenID, $desc){
	$sql = "insert into deskripsi_bobot ".
			"values ($nilai, '$dekripenID', '$desc')";
	return mysql_query($sql);
}

function debot_update($nilai, $dekripenID, $desc){
	$sql = "update deskripsi_bobot 
			set DESKRIPSI = '$desc'  
			where NILAI = $nilai AND ID_DETAIL_KRITERIA='$dekripenID'";
	return mysql_query($sql);
}

/**
 * delete data divisi
 * @param $divID (string) - kode divisi
 */
function debot_delete($nilai, $dekripenID){
	$sql = "delete from deskripsi_bobot ".
			"where NILAI=$nilai AND ID_DETAIL_KRITERIA='$dekripenID'";
	return mysql_query($sql);
}