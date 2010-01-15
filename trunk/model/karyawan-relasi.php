<?php
/**
 * RELASI_GOLONGAN
 */
function RELASIGOLONGAN_insert($golID, $karyID, $tglMenjabat, $tglBerhenti){
	$sql = "INSERT INTO relasi_golongan 
			VALUES ('$golID', '$karyID', '$tglMenjabat', '$tglBerhenti')";
	return mysql_query($sql);
}

function RELASIGOLONGAN_isExist($golID, $karyID){
	$sql = "SELECT * FROM relasi_golongan 
			WHERE 
				ID_GOLONGAN = '$golID' AND 
				KODE_KARYAWAN = '$karyID'";
	$res = mysql_fetch_assoc(mysql_query($sql));
	if ($res['golID']===$golID && $res['KODE_KARYAWAN']===$karyID) return true;
	return false;
}

function RELASIGOLONGAN_delete($id){
	$sql = "delete from relasi_golongan  
			where
				KODE_KARYAWAN = '$id'";
	//ID_GOLONGAN = '$id' OR
	return mysql_query($sql);
}

function RELASIGOLONGAN_load($karyID){
	$sql = "SELECT 
				a.ID_GOLONGAN, 
				b.NAMA_GOLONGAN,
				a.KODE_KARYAWAN,
				a.TANGGAL_MENJABAT,
				a.TANGGAL_BERHENTI 
			FROM 
				relasi_golongan a,
				data_golongan b
			WHERE a.ID_GOLONGAN = b.ID_GOLONGAN AND 
					a.KODE_KARYAWAN = '$karyID'";
	return mysql_query($sql);
}


function RELASIDIVJABDIN_insert($karyID, $tglMenjabat, $tglBerhenti, $ID_DEP_DIV_JAB){
	$sql = "INSERT INTO relasi_div_jab_din 
			VALUES ('$karyID', '$tglMenjabat', '$tglBerhenti', '$ID_DEP_DIV_JAB')";
	return mysql_query($sql);
}

function RELASIDIVJABDIN_delete($karyID, $dep_div_jabID){
	$sql = "delete from relasi_div_jab_din 
			where KODE_KARYAWAN = '$karyID' AND ID_DEP_DIV_JAB=$dep_div_jabID";
	//ID_DEP_DIV_JAB = '$id' OR
	return mysql_query($sql);
}

/**
 * kode relasi terakhir
 * @return unknown_type
 */
function DEPDIVJAB_getLastID(){
	$sql = "SELECT MAX(ID_DEP_DIV_JAB) as MAX FROM dep_divisi_jabatan";
	$res = mysql_fetch_assoc(mysql_query($sql));
	return intval($res['MAX']);
}

function DEPDIVJAB_isExistID($dep_div_jabID){
	$sql = "SELECT * FROM dep_divisi_jabatan WHERE ID_DEP_DIV_JAB=$dep_div_jabID";
	$res = mysql_query($sql);
	while (mysql_fetch_assoc($res)){ return true; }
	return false;
}

function DEPDIVJAB_insert($ID_DEP_DIV_JAB, $jbtID, $divID, $depID){
	$sql = "INSERT INTO dep_divisi_jabatan 
		VALUES ('$ID_DEP_DIV_JAB', '$jbtID', '$divID', '$depID')";
	return mysql_query($sql);
}

function DEPDIVJAB_update($ID_DEP_DIV_JAB, $jbtID, $divID, $depID){
	$sql = "UPDATE dep_divisi_jabatan 
			SET  ID_JABATAN='$jbtID', 
				ID_DIVISI='$divID',
				ID_DEPARTMENT='$depID'
			WHERE ID_DEP_DIV_JAB='$ID_DEP_DIV_JAB'";
	return mysql_query($sql);
}

function DEPDIVJAB_delete($idDEPDIVJAB){
	$sql = "delete from dep_divisi_jabatan  
			where
				ID_DEP_DIV_JAB = '$idDEPDIVJAB'";
	return mysql_query($sql);
}

function RELASIJABATAN_load($karyID=false, $dep_div_jabID=false){
	$sql = "SELECT  
			  a.KODE_KARYAWAN, 
			  a.TANGGAL_MENJABAT,  
			  a.TANGGAL_BERHENTI,   
			  a.ID_DEP_DIV_JAB, 
			  b.ID_JABATAN, 
			  c.NAMA_JABATAN, 
			  c.LEVEL_JABATAN, 
			  b.ID_DIVISI, 
			  d.NAMA_DIVISI, 
			  b.ID_DEPARTMENT, 
			  e.NAMA_DEPARTMENT   
			FROM 
			  relasi_div_jab_din as a, 
			  dep_divisi_jabatan as b, 
			  data_jabatan as c, 
			  data_divisi as d, 
			  data_department as e 
			WHERE  
			  a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND  
			  b.ID_JABATAN = c.ID_JABATAN AND  
			  b.ID_DIVISI = d.ID_DIVISI AND 
			  b.ID_DEPARTMENT = e.ID_DEPARTMENT ";
	
	if ($karyID){
		$sql .= " AND a.KODE_KARYAWAN = '$karyID'";
	}
	
	if ($dep_div_jabID){
		$sql .= " AND a.ID_DEP_DIV_JAB = '$dep_div_jabID'";
	}
	
	return mysql_query($sql);
}