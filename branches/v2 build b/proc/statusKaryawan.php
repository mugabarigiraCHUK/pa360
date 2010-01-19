<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/statusKaryawan.php';

$proc = $_REQUEST['proc'];

/**
 * row table untuk 
 */
if ($proc === 'stskary-table'){
	$key = $_POST['key'];
	include '../view/admin/statusKaryawan/tableList.php';
}

/**
 * modal untuk add divisi
 */
if ($proc === 'add-modal'){
	include '../view/admin/statusKaryawan/stskary_add.php';
} 

/**
 * modal untuk update divisi
 */
if ($proc === 'edit-modal'){
	$stsID = $_POST['stsID'];
	include '../view/admin/statusKaryawan/stskary_edit.php';
}

if ($proc === 'stskary-save'){
	$stsID = $_POST['stsID'];
	$nama = $_POST['nama'];

	if ($stsID === '' || is_null($stsID)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Divisi"));
		return ;
	}

	if (stskary_isExistID($stsID)){
		echo json_encode(array('error'=> true, 'msg'=> "ID Status sudah terpakai ..."));
		return ;
	}
	
	$ex = stskary_add($stsID, $nama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'stskary-update'){
	$stsID = $_POST['stsID'];
	$nama = $_POST['nama'];
	
	$ex = stskary_update($stsID, $nama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'stskary-delete'){
	$stsID = $_POST['stsID'];
	$ex = stskary_delete($stsID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}