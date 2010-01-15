<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/tag.php';
include '../model/jabatan.php';

$proc = $_REQUEST['proc'];

if ($proc === 'add-modal'){
	include '../view/admin/jabatan/jabatan_add.php';
}

if ($proc === 'edit-modal'){
	$jbtID = $_POST['jbt_id'];
	include '../view/admin/jabatan/jabatan_edit.php';
}

/**
 * simpan jabatan
 */
if ($proc === 'jabatan-save'){
	$id=$_POST['jbt_id'];
	$nama=$_POST['nama'];
	$level=$_POST['level'];
	
	if (!$id || $id===''){
		echo json_encode(array('error'=> true, 'msg'=> 'ID Jabatan mohon diisi...'));
		return;
	}
	
	$ex = jbt_insert($id, $nama, $level[0] .'.'. $level[1]);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'jabatan-update'){
	$id = $_POST['jbt_id'];
	$nama = $_POST['nama'];
	$level = $_POST['level'];
	$ex = jbt_update($id, $nama, $level[0] .'.'. $level[1]);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'jabatan-delete'){
	$id=$_REQUEST['jbt_id'];
	$ex = jbt_delete($id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

/**
 * list pada jabatan table
 */
if ($proc === 'jabatan-table-list'){
	$key = $_POST['key'];
	include '../view/admin/jabatan/tableList.php';
}

