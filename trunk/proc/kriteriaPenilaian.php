<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/kriteriaPenilaian.php';
include '../model/detilBobotLevel.php';
include '../model/deskripsiBobot.php';

$proc = $_REQUEST['proc'];

/**
 * row table untuk 
 */
if ($proc === 'kripen-table'){
	$key = $_POST['key'];
	include '../view/admin/kriteriaPenilaian/tableList.php';
}

/**
 * modal untuk add divisi
 */
if ($proc === 'add-modal'){
	include '../view/admin/kriteriaPenilaian/kripen_add.php';
} 

/**
 * modal untuk update divisi
 */
if ($proc === 'edit-modal'){
	$kripenID = $_POST['kripenID'];
	if (debotlv_kripenIsExist($kripenID)){
		echo json_encode(array('error'=> true, 'msg'=> "Referensi data terpakai, proses edit tidak diperbolehkan"));
		return false;
	}
	
	include '../view/admin/kriteriaPenilaian/kripen_edit.php';
}

if ($proc == 'kripen-save'){
	$kripenID = $_POST['kripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$standart = $_POST['standart'];
	
//	if (kripen_isExistID($kripenID)){
//		echo json_encode(array('error'=> true, 'msg'=> "ID Status sudah terpakai ..."));
//		return ;
//	}
	
	if ($nama === '' || is_null($nama)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi Nama Kriteria ..."));
		return ;
	}
	
	if ($standart<0 || !is_numeric($standart)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi Nilai Standart Kriteria ..."));
		return ;
	}
	
	//automatic generate ID
	$ex = kripen_add($kripenID, $nama, $desc, $standart);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'kripen-update'){
	$kripenID = $_POST['kripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$standart = $_POST['standart'];
	
	if ($nama === '' || is_null($nama)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi Nama Kriteria ..."));
		return ;
	}
	
	$ex = kripen_update($kripenID, $nama, $desc, $standart);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'kripen-delete'){
	$kripenID = $_POST['kripenID'];
	$ex = kripen_delete($kripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}