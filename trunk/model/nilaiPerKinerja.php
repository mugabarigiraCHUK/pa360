<?php

/**
 * 
 * @param $id
 * @param $dekripenID
 * @param $npkrtID - ID nilai_per_kriteria
 * @param $nilai
 * @return unknown_type
 */
function npk_add($id, $dekripenID, $npkrtID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "INSERT INTO nilai_per_kinerja 
			VALUES('$id','$dekripenID', '$npkrtID', $nilai)";
	return mysql_query($sql);
}

function npk_update($id=false, $dekripenID, $npkrtID, $nilai){
	$sql = "UPDATE nilai_per_kinerja
				set NILAI = $nilai
			WHERE ID_DETAIL_KRITERIA='$dekripenID'
				AND ID_NILAI_PER_KRITERIA='$npkrtID'";
	if ($id){
		$sql .= " AND ID_NILAI_PER_KINERJA='$id' ";
	}
	return mysql_query($sql);
}

function npk_delete($id){
	$sql = "DELETE FROM nilai_per_kinerja 
			WHERE ID_NILAI_PER_KINERJA='$id'";
	return mysql_query($sql);
}

function npk_getID($dekripenID, $npkrtID, $nilai=false){
	$sql = npk_select(false, $dekripenID, $npkrtID, $nilai);
	while ($row = mysql_fetch_assoc($sql)){
		return $row['ID_NILAI_PER_KINERJA'];
	}
	return false;
}

function npk_exist($id=false, $dekripenID, $npkrtID){
	$sql = npk_select($id, $dekripenID, $npkrtID);
	while ($row = mysql_fetch_assoc($sql)){
		return true;
	}
	return false;
}

function npk_existByID($id){
	$sql = npk_select($id);
	$rs = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rs)){
		return true;
	}
	return false;
}

function npk_select($id=false, $dekripenID=false, $npkrtID=false, $nilai=false){
	$sql = "SELECT * FROM nilai_per_kinerja ";
	if ($id){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " ID_NILAI_PER_KINERJA='$id' "; 
	}
	if ($dekripenID){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " ID_DETAIL_KRITERIA='$dekripenID' "; 
	}
	if ($npkrtID){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " ID_NILAI_PER_KRITERIA='$npkrtID' "; 
	}
	if ($nilai){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " NILAI='$nilai' "; 
	}
	$sqlw = $sqlw==""? "" : " WHERE ".$sqlw;
	return mysql_query($sql.$sqlw);
}