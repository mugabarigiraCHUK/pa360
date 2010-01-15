<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/golongan.php';
include '../model/departemen.php';

$proc = $_REQUEST['proc'];

/**
 * row table untuk 
 */
if ($proc === 'departemen-table'){
	$key = $_POST['key'];
	include '../view/admin/departemen/tableList.php';
}

/**
 * modal untuk add departemen
 */
if ($proc === 'add-modal'){
	include '../view/admin/departemen/dep_add.php';
} 

/**
 * modal untuk update departemen
 */
if ($proc === 'edit-modal'){
	$dep_id = $_POST['dep_id'];
	include '../view/admin/departemen/dep_edit.php';
}

/**
 * save departemen
 */
if ($proc === 'departemen-save'){
	$dep_id = $_POST['dep_id'];
	$depNama = $_POST['depNama'];
	
	if ($dep_id === '' || is_null($dep_id)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Departemen"));
		return ;
	}
	
	$ex = departemen_add($dep_id, $depNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'departemen-update'){
	$dep_id = $_POST['dep_id'];
	$depNama = $_POST['depNama'];
		
	$ex = departemen_update($dep_id, $depNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'departemen-delete'){
	$dep_id = $_POST['dep_id'];
	$ex = departemen_delete($dep_id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}