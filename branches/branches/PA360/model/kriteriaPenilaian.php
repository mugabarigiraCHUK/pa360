<?php

function kripen_select($key=false){
	$sql = "select * from kriteria_penilaian";
	if ($key){
		$sql .= " where 
					ID_KRITERIA like '%$key%' OR
					NAMA_KRITERIA like '%$key%' OR
					DESKRIPSI like '%$key%' OR
					BOBOT like '%$key%'";
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

function kripen_summarize($exculdeID=false){
	$sql = "select * from kriteria_penilaian ".
	$sql .= $exculdeID? "where ID_KRITERIA != '$exculdeID'" : "";
	
	$result = mysql_query($sql);
	$total = 0;
	while ($row = mysql_fetch_assoc($result)){
		$total += $row['BOBOT'];
	}

	return $total;
}

/**
 * insert data divisi
 * @param $divID (string) - kode divisi
 * @param $depID (string) - kode departemen
 * @param $divNama (string) - nama divisi
 */
function kripen_add($kripenID, $nama, $desc, $bobot){
	$sql = "insert into kriteria_penilaian ".
			"values ('$kripenID', '$nama', '$desc', $bobot)";
	return mysql_query($sql);
}

function kripen_update($kripenID, $nama, $desc, $bobot){
	$sql = "update kriteria_penilaian ".
			"set NAMA_KRITERIA = '$nama',  
				DESKRIPSI = '$desc',
				BOBOT = $bobot 
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