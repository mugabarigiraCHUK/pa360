<?php

function npp_select($where=false, $orderBy=false){
	$sql = "SELECT * FROM nilai_per_penilai ";
	if ($where){
		$sql .= " WHERE ". $where;
	}
	if ($orderBy){
		$sql .= " ORDER BY ". $orderBy;
	}
	return mysql_query($sql);
}

function npp_load($dinilaiID, $penilaiID, $bobotlvID, $orderby=false){
	$sql = "KODE_DINILAI='$dinilaiID' 
			AND KODE_PENILAI='$penilaiID' 
			AND ID_BOBOT_LEVEL='$bobotlvID'";
	return npp_select($sql, $orderby);
	
}

function npp_loadByID($nppID){
	$sql = "SELECT * FROM nilai_per_penilai 
			WHERE ID_NILAI_PER_PENILAI = '$nppID'";
	return mysql_query($sql);
}

function npp_loadComplete($where=false){
	$where = !$where? "" : " AND ".$where;
	$sql = "SELECT a.ID_NILAI_PER_PENILAI, 
			    a.KODE_DINILAI, 
			    b.KODE_KARYAWAN as KODE_KARYAWAN_DINILAI,
			    b.ID_DEP_DIV_JAB as ID_DEP_DIV_JAB_DINILAI,
			    b.ID_PERIODE as ID_PERIODE_DINILAI,
			    b.NILAI_AKHIR as NILAI_AKHIR_DINILAI,
			    a.KODE_PENILAI, 
			    c.KODE_KARYAWAN as KODE_KARYAWAN_PENILAI,
			    c.ID_DEP_DIV_JAB as ID_DEP_DIV_JAB_PENILAI,
			    a.ID_BOBOT_LEVEL, 
			    a.NILAI
			FROM nilai_per_penilai as a, 
			    nilai_akhir as b, 
			    penilai as c
			WHERE a.KODE_DINILAI=b.KODE_DINILAI AND a.KODE_PENILAI=c.KODE_PENILAI
				$where
			GROUP BY ID_NILAI_PER_PENILAI";
	return mysql_query($sql);
}

function npp_isExist($dinilaiID, $penilaiID, $bobotlvID){
	$res = npp_load($dinilaiID, $penilaiID, $bobotlvID);
	while ($row = mysql_fetch_assoc($res)){ return true; }
	return false;
}

function npp_isExistID($id){
	$res = npp_loadByID($id);
	while ($row = mysql_fetch_assoc($res)){ return true; }
	return false;
}

function npp_delete($nppID){
	$sql = "Delete from nilai_per_penilai WHERE ID_NILAI_PER_PENILAI = '$nppID'";
	return mysql_query($sql);
}

function npp_insert($dinilaiID, $penilaiID, $bobotlvID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "INSERT INTO nilai_per_penilai (KODE_DINILAI, KODE_PENILAI, ID_BOBOT_LEVEL, NILAI) 
			VALUES ('$dinilaiID', '$penilaiID', '$bobotlvID', '$nilai')";
	return mysql_query($sql);
}

function npp_update($nppID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "UPDATE nilai_per_penilai set NILAI=$nilai   
			WHERE ID_NILAI_PER_PENILAI='$nppID'";
	return mysql_query($sql);
}