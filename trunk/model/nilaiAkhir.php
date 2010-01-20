<?php
function nilaiAkhir_select($id=false, $karyID=false, $dep_div_jabID=false, $periodeID=false){
	$sql = "SELECT * FROM nilai_akhir ";
	$sqlw = false;
	
	if ($id){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "KODE_DINILAI='$id'";
	}
	if ($karyID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "KODE_KARYAWAN='$karyID'";
	}
	if ($periodeID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "ID_PERIODE='$periodeID'";
	}
	if ($dep_div_jabID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "ID_DEP_DIV_JAB='$dep_div_jabID'";
	}		
	$sql .= $sqlw? " WHERE ".$sqlw : ""; 
	return mysql_query($sql);
}

function nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID){
	return nilaiAkhir_select(false, $karyID, $dep_div_jabID, $periodeID);
}

function nilaiAkhir_loadByID($id){
	return nilaiAkhir_select($id);
}

function nilaiAkhir_isExist($karyID, $dep_div_jabID, $periodeID){
	$sql = nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID);
	while ($row = mysql_fetch_assoc($sql)){ return true; }
	return false;
}

function nilaiAkhir_isExistID($id){
	$sql = nilaiAkhir_loadByID($id);
	while ($row = mysql_fetch_assoc($sql)){ return true; }
	return false;
}

function nilaiAkhir_add($karyID, $dep_div_jabID, $periodeID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "INSERT INTO nilai_akhir (KODE_KARYAWAN, ID_DEP_DIV_JAB, ID_PERIODE, NILAI_AKHIR)
			VALUES ('$karyID', '$dep_div_jabID', '$periodeID', '$nilai')";
	return mysql_query($sql);
}

function nilaiAkhir_delete($id){
	$sql = "DELETE FROM nilai_akhir WHERE KODE_DINILAI='$id'";
	return mysql_query($sql);
}

function nilaiAkhir_update($karyID, $periodeID, $dep_div_jabID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "UPDATE nilai_akhir
			SET NILAI_AKHIR=$nilai 
			WHERE KODE_KARYAWAN='$karyID' AND 
			ID_PERIODE='$periodeID' AND 
			ID_DEP_DIV_JAB='$dep_div_jabID'";
	return mysql_query($sql);
}

function nilaiAkhir_count($periodeID, $departemenID=false, $threshold=false){
	$sql = "select count(NILAI_AKHIR) as AVG 
			from 
			  nilai_akhir as a,
			  dep_divisi_jabatan as b
			where 
			  a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
			  a.ID_PERIODE='$periodeID' ";
	
	if ($departemenID){
		$sql .= " AND b.ID_DEPARTMENT='$departemenID'";
	}
	if ($threshold){
		$sql .= " AND $threshold";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}

function nilaiAkhir_avg($periode, $departemen=false){  
	$sql = "select avg(NILAI_AKHIR) as AVG 
			from 
			  nilai_akhir as a,
			  dep_divisi_jabatan as b
			where 
			  a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
			  a.ID_PERIODE='$periode' ";
	
	if ($departemen){
		$sql .= " AND b.ID_DEPARTMENT='$departemen'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}

function nilaiAkhir_max($periode, $departemen=false){  
	$sql = "select max(NILAI_AKHIR) as AVG 
			from 
			  nilai_akhir as a,
			  dep_divisi_jabatan as b
			where 
			  a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
			  a.ID_PERIODE='$periode' ";
	
	if ($departemen){
		$sql .= " AND b.ID_DEPARTMENT='$departemen'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}

function nilaiAkhir_min($periode, $departemen=false){  
	$sql = "select min(NILAI_AKHIR) as AVG 
			from 
			  nilai_akhir as a,
			  dep_divisi_jabatan as b
			where 
			  a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
			  a.ID_PERIODE='$periode' ";
	
	if ($departemen){
		$sql .= " AND b.ID_DEPARTMENT='$departemen'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}