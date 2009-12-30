<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/kriteriaPenilaian.php';

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
	include '../view/admin/kriteriaPenilaian/kripen_edit.php';
}

if ($proc == 'kripen-save'){
	$kripenID = $_POST['kripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$bobot = $_POST['bobot'];
	
	if ($kripenID === '' || is_null($kripenID)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Kriteria ..."));
		return ;
	}

	if (kripen_isExistID($kripenID)){
		echo json_encode(array('error'=> true, 'msg'=> "ID Status sudah terpakai ..."));
		return ;
	}
	
	$sum = kripen_summarize();
	if ($sum + $bobot>100){
		echo json_encode(array('error'=> true, 'msg'=> "total bobot kriteria lebih dari 100%, mohon cek ulang ..."));
		return ;
	}
	
	$ex = kripen_add($kripenID, $nama, $desc, $bobot);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'kripen-update'){
	$kripenID = $_POST['kripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$bobot = $_POST['bobot'];
	
	$sum = kripen_summarize($kripenID);
	if ($sum + $bobot>100){
		echo json_encode(array('error'=> true, 'msg'=> 
			"Total bobot kriteria lebih dari 100%, mohon cek ulang ... ". ($sum + $bobot)));
		return ;
	}
	
	$ex = kripen_update($kripenID, $nama, $desc, $bobot);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'kripen-delete'){
	$kripenID = $_POST['kripenID'];
	$ex = kripen_delete($kripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}