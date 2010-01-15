<?php 

function detilStatusKaryawan_select($id, $orderBy=false){
	$sql = "select 	detil_status_karyawan.KODE_KARYAWAN,
			 		data_karyawan.NAMA_KARYAWAN,
					detil_status_karyawan.ID_STATUS_KARYAWAN,
					status_karyawan.NAMA_STATUS,
					detil_status_karyawan.TGL_UPDATE_STATUS 
			from detil_status_karyawan, data_karyawan, status_karyawan 
			where detil_status_karyawan.KODE_KARYAWAN = data_karyawan.KODE_KARYAWAN AND
					detil_status_karyawan.ID_STATUS_KARYAWAN = status_karyawan.ID_STATUS_KARYAWAN ";
	if ($id){
		$sql .= " AND detil_status_karyawan.KODE_KARYAWAN = '$id' ";
	}
	
	if ($orderBy){
		$sql .= " ORDER BY TGL_UPDATE_STATUS ". $orderBy;
	}
	else{
		$sql .= " ORDER BY TGL_UPDATE_STATUS ASC";
	}
	
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

/**
 * load detail status yang terbaru
 * @param $id
 */
function detilStatusKaryawan_load($id){
	$sql = "select 
					detil_status_karyawan.KODE_KARYAWAN,
			 		data_karyawan.NAMA_KARYAWAN,
					detil_status_karyawan.ID_STATUS_KARYAWAN,
					status_karyawan.NAMA_STATUS,
					detil_status_karyawan.TGL_UPDATE_STATUS 
			from 	detil_status_karyawan, data_karyawan, status_karyawan 
			where 	detil_status_karyawan.KODE_KARYAWAN = data_karyawan.KODE_KARYAWAN AND
					detil_status_karyawan.ID_STATUS_KARYAWAN = status_karyawan.ID_STATUS_KARYAWAN AND
			 		detil_status_karyawan.KODE_KARYAWAN = '$id' 
			ORDER BY TGL_UPDATE_STATUS DESC 
			LIMIT 0 , 1";
	return mysql_query($sql);
}

function detilStatusKaryawan_isExistID($id){
	$sql = "select * from detil_status_karyawan
			where KODE_KARYAWAN = '$id'";
	
	$result = mysql_query($sql);
	$result = mysql_fetch_assoc($result);
	if ($res['KODE_KARYAWAN'] === $id) return true;
	return false;
}

/**
 * insert data Detil Status Karyawan
 * @param $karyID (string) - kode detil status karyawan
 * @param $staKarID (string) - kode status karyawan
 * @param $tglUpdate (string) - tanggal update
 */
function detilStatusKaryawan_add($karyID, $staKarID, $tglUpdate){
	$sql = "insert into detil_status_karyawan ".
			"values ('$karyID','$staKarID','$tglUpdate')";
	return mysql_query($sql);
}

function detilStatusKaryawan_update($karyID, $staKarID, $tglUpdate){
	$sql = "update 	detil_status_karyawan ".
			"set 	ID_STATUS_KARYAWAN = '$staKarID',
			  	 	TGL_UPDATE_STATUS = '$tglUpdate'
			where 	KODE_KARYAWAN='$karyID'";
	return mysql_query($sql);
}

/**
 * delete data detilStatusKaryawan
 * @param $karyID (string) - kode Karyawan
 */
function detilStatusKaryawan_delete($karyID, $staKarID, $tglUpdate){
	$sql = "delete 	from detil_status_karyawan
			where 	KODE_KARYAWAN='$karyID' AND 
					ID_STATUS_KARYAWAN = '$staKarID' AND 
			  	 	TGL_UPDATE_STATUS = '$tglUpdate'";
	return mysql_query($sql);
}
