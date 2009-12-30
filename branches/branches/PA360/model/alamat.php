<?php
/**
 * 
 * @param $alamat
 * @param $kodePos
 * @param $kodeArea
 * @param $kota
 * @param $propinsi
 */
function alamat_insert($id, $kodeKaryawan, $alamat, $kodePos, $kodeArea, $kota, $propinsi){
	$sql = "insert into alamat 
		values ('$id', '$kodeKaryawan', '$alamat', $kodePos, $kodeArea, '$kota', '$propinsi')";
	return mysql_query($sql);
}

function alamat_delete($id){
	$sql = "delete from alamat 
			where
				KODE_KARYAWAN = '$id'";
	return mysql_query($sql);
}

function alamat_load($karyID){
	$sql = "select * from alamat where KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);
}