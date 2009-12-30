<?php

function npp_select($where=false){
	$sql = "SELECT * FROM nilai_per_penilai ";
	
	if ($where){
		$sql .= " WHERE ". $where;
	}
	
	return mysql_query($sql);
}

function npp_load($karyID, $penilaiID, $periodeID, $dep_div_jabID, $levelID){
	$sql = "SELECT * FROM nilai_per_penilai 
			WHERE KODE_KARYAWAN = '$karyID' AND  
				PENILAI = '$penilaiID' AND 
				ID_PERIODE = '$periodeID' AND 
				ID_DEP_DIV_JAB = '$dep_div_jabID' AND 
				ID_LEVEL = '$levelID'";
	return mysql_query($sql);
}

/**
 * 
 * @param $nppID (string) - ID nilai per pernilai
 */
function npp_load2($nppID){
	$sql = "SELECT * FROM nilai_per_penilai 
			WHERE ID_NILAI_PER_PENILAI = '$nppID'";
	return mysql_query($sql);
}

function npp_load3($where=false){
	$where = !$where? "" : $where;
	$sql = "SELECT 
			  a.KODE_KARYAWAN, b.NAMA_KARYAWAN, a.ID_DEP_DIV_JAB, c.ID_JABATAN, 
			  d.NAMA_JABATAN, d.LEVEL_JABATAN, c.ID_DIVISI, e.NAMA_DIVISI, 
			  c.ID_DEPARTMENT, f.NAMA_DEPARTMENT, a.ID_LEVEL, g.NAMA_LEVEL 
			FROM 
			  nilai_per_penilai as a, data_karyawan as b, dep_divisi_jabatan as c, 
			  data_jabatan as d, data_divisi as e, data_department as f,
			  bobot_level as g 
			WHERE 
			  a.KODE_KARYAWAN = b.KODE_KARYAWAN AND 
			  a.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB AND 
			  c.ID_JABATAN = d.ID_JABATAN AND 
			  c.ID_DIVISI = e.ID_DIVISI AND  
			  c.ID_DEPARTMENT = f.ID_DEPARTMENT AND 
			  a.ID_LEVEL = g.ID_LEVEL AND 
			  $where 
			  GROUP BY a.ID_DEP_DIV_JAB ";
	return mysql_query($sql);
}

function npp_delete($nppID){
	$sql = "Delete from nilai_per_penilai WHERE ID_NILAI_PER_PENILAI = '$nppID'";
	return mysql_query($sql);
}

function npp_insert($karyID, $penilaiID, $periodeID, $dep_div_jabID, $nppID, $levelID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "INSERT INTO nilai_per_penilai VALUES 
			('$karyID', '$penilaiID', '$periodeID', '$dep_div_jabID', '$nppID', '$levelID', $nilai)";
	return mysql_query($sql);
}