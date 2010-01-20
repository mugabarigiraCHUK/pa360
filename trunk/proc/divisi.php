<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/divisi.php';

$proc = $_REQUEST['proc'];

/**
 * row table untuk 
 */
if ($proc === 'divisi-table'){
	$key = $_POST['key'];
	include '../view/admin/divisi/tableList.php';
}

/**
 * modal untuk add divisi
 */
if ($proc === 'add-modal'){
	include '../view/admin/divisi/divisi_add.php';
} 

/**
 * modal untuk update divisi
 */
if ($proc === 'edit-modal'){
	$divID = $_POST['divID'];
	include '../view/admin/divisi/divisi_edit.php';
}

if ($proc === 'divisi-save'){
	$divID = $_POST['divID'];
	$divNama = $_POST['divNama'];
	
	if ($divID === '' || is_null($divID)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Divisi"));
		return ;
	}
	
	if (divisi_isExistID($divID)){
		echo json_encode(array('error'=> true, 'msg'=> "ID Divisi telah terpakai"));
		return ;
	}
	
	$ex = divisi_add($divID, $divNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'divisi-update'){
	$divID = $_POST['divID'];
	$divNama = $_POST['divNama'];
	
	$ex = divisi_update($divID, $divNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'divisi-delete'){
	$divID = $_POST['divID'];
	$ex = divisi_delete($divID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}