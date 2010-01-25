<?php
/**
 * 
 * @param $kodeKaryawan
 * @param $alamat
 * @param $kodePos
 * @param $kodeArea
 * @param $kota
 * @param $propinsi
 * @return unknown_type
 */
function alamat_insert($kodeKaryawan, $alamat, $kodePos, $kodeArea, $kota, $propinsi){
	$sql = "insert into alamat (`KODE_KARYAWAN`, `NAMA_ALAMAT`, `KODE_POS`, `KODE_AREA`, `KOTA`, `PROPINSI`)
		values ('$kodeKaryawan', '$alamat', $kodePos, $kodeArea, '$kota', '$propinsi')";
	return mysql_query($sql);
}

function alamat_delete($alamatID, $karyID){
	$sql = "delete from alamat 
			where
				ID_ALAMAT=$alamatID AND 
				KODE_KARYAWAN = '$karyID'";
	return mysql_query($sql);
}

function alamat_load($karyID){
	$sql = "select * from alamat where KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);
}

function alamat_update($alamatID, $karyID, $alamat, $kodePos, $kodeArea, $kota, $propinsi){
	$sql = "UPDATE  alamat
			SET NAMA_ALAMAT='$alamat',
				KODE_POS=$kodePos, 
				KODE_AREA=$kodeArea, 
				KOTA='$propinsi', 
				PROPINSI='$propinsi' 
			WHERE ID_ALAMAT=$alamatID 
				AND KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);	
}

function alamat_isExistID($alamatID, $karyID){
	$sql = "SELECT * 
			FROM alamat
			WHERE ID_ALAMAT=$alamatID
				AND KODE_KARYAWAN='$karyID'";
	$res = mysql_query($sql);
	if (! $res) return false;
	while (mysql_fetch_assoc($res)){ return true; }
	return false;
}