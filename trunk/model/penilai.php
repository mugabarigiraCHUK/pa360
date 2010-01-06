<?php
include 'nilaiPerPenilai.php';
include 'nilaiPerKinerja.php';
include 'nilaiPerKriteria.php';
include 'nilaiAkhir.php';

function penilai_select($karyID, $periodeID){
	$sql = "SELECT * FROM penilai where KODE_KARYAWAN = '$karyID' AND ID_PERIODE='$periodeID'";
	return mysql_query($sql);
}

function penilai_load($karyID, $periodeID, $levelID){
	$sql = "SELECT a.KODE_KARYAWAN, 
				f.NAMA_KARYAWAN, 
				a.ID_PERIODE, 
				a.ID_DEP_DIV_JAB, 
				a.ID_LEVEL, 
				a.STATUS_PENILAIAN,  
				b.ID_JABATAN, 
				c.NAMA_JABATAN, 
				b.ID_DIVISI, 
				d.NAMA_DIVISI, 
				b.ID_DEPARTMENT, 
				e.NAMA_DEPARTMENT 
			FROM penilai AS a, 
				dep_divisi_jabatan AS b, 
				data_jabatan AS c, 
				data_divisi AS d, 
				data_department AS e, 
				data_karyawan AS f 
			WHERE a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND 
				b.ID_JABATAN = c.ID_JABATAN AND
				b.ID_DIVISI = d.ID_DIVISI AND
				b.ID_DEPARTMENT = e.ID_DEPARTMENT AND
				a.KODE_KARYAWAN = f.KODE_KARYAWAN AND 
				a.KODE_KARYAWAN='$karyID' AND 
				a.ID_PERIODE='$periodeID' AND 
				a.ID_LEVEL='$levelID'";
	return mysql_query($sql);
}

function penilai_add($karyID, $periodeID, $dep_div_jabID, $levelID, $stsPenilaian){
	$sql = "INSERT INTO  penilai  
			VALUES ('$karyID' , '$periodeID', '$dep_div_jabID', '$levelID', '$stsPenilaian')";
	return mysql_query($sql);
}