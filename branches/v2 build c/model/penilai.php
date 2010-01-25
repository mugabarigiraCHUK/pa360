<?php
include 'nilaiPerPenilai.php';
include 'nilaiPerKinerja.php';
include 'nilaiPerKriteria.php';
include 'nilaiAkhir.php';

function penilai_select($id=false, $karyID=false, $dep_div_jabID=false){
	$sql = "SELECT * FROM penilai";
	
	if ($id){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " KODE_PENILAI='$id'";
	}
	if ($karyID){ 
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " KODE_KARYAWAN='$karyID'";
	}
	if ($dep_div_jabID){ 
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= " ID_DEP_DIV_JAB='$dep_div_jabID'";
	}

	$sql .= $sqlw==""? "":" WHERE ".$sqlw;
	return mysql_query($sql);
}

function penilai_load($karyID, $dep_div_jabID){
	return penilai_select(false, $karyID, $dep_div_jabID);
}

function penilai_loadByID($id){
	return penilai_select($id);
}

function penilai_isExist($karyID, $dep_div_jabID){
	$res = penilai_load($karyID, $dep_div_jabID);
	while ($row=mysql_fetch_assoc($res)){ return true; }
	return false;
}

function penilai_isExistByID($id){
	$res = penilai_loadByID($id);
	while ($row=mysql_fetch_assoc($res)){ return true; }
	return false;
}

function penilai_add($karyID, $dep_div_jabID){
	$sql = "INSERT INTO  penilai (KODE_KARYAWAN, ID_DEP_DIV_JAB)
			VALUES ('$karyID' , '$dep_div_jabID')";
	return mysql_query($sql);
}