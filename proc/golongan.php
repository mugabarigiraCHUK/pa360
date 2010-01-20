<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/golongan.php';
//include '../model/departemen.php';

$proc = $_REQUEST['proc'];

/**
 * row table untuk 
 */
if ($proc === 'golongan-table'){
	$key = $_POST['key'];
	include '../view/admin/golongan/tableList.php';
}

/**
 * modal untuk add golongan
 */
if ($proc === 'add-modal'){
	include '../view/admin/golongan/gol_add.php';
} 

/**
 * modal untuk update golongan
 */
if ($proc === 'edit-modal'){
	$gol_id = $_POST['gol_id'];
	include '../view/admin/golongan/gol_edit.php';
}

/**
 * save golongan
 */
if ($proc === 'golongan-save'){
	$gol_id = $_POST['gol_id'];
	$golNama = $_POST['golNama'];
	
	if ($gol_id === '' || is_null($gol_id)){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Golongan"));
		return ;
	}
	
	$ex = golongan_add($gol_id, $golNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'golongan-update'){
	$gol_id = $_POST['gol_id'];
	$golNama = $_POST['golNama'];
		
	$ex = golongan_update($gol_id, $golNama);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'golongan-delete'){
	$gol_id = $_POST['gol_id'];
	$ex = golongan_delete($gol_id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}