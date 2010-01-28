<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/kriteriaPenilaian.php';
include '../model/detilKriteriaPenilaian.php';
include '../model/deskripsiBobot.php';

$proc = $_REQUEST['proc'];

if ($proc === 'search-modal'){
	include '../view/admin/detilKriteriaPenilaian/search.php';
}

/**
 * row table untuk 
 */
if ($proc === 'debot-table'){
	$key = $_POST['key'];
	$dekripenID = $_POST['dekripenID'];
	$debotID = $_POST['debotID'];
	include '../view/admin/deskripsiBobot/tableList.php';
}

/**
 * untuk combo detail kriteria
 */
if ($proc === 'debot-dekripenCombo'){
	$kripenID = $_POST['kripenID'];
	include '../view/admin/deskripsiBobot/comboDekripen.php';
}

/**
 * modal untuk add 
 */
if ($proc === 'add-modal'){
	$kripenID = $_POST['kripenID'];
	$dekripenID = $_POST['dekripenID']; 
	include '../view/admin/deskripsiBobot/debot_add.php';
} 

/**
 * modal untuk update 
 */
if ($proc === 'edit-modal'){
	$kripenOD = $_POST['kripenID'];
	$dekripenID = $_POST['dekripenID'];
	$nilai = intval($_POST['nilai']);
	include '../view/admin/deskripsiBobot/debot_edit.php';
}

if ($proc == 'debot-save'){
	$dekripenID = $_POST['dekripenID'];
	$nilai = $_POST['nilai'];
	$desc = $_POST['desc'];
	
	//normalisasi bobot
	$nilai = $nilai<0? 0 : $nilai;
	$nilai = $nilai>100? 100 : $nilai;
	
	if (debot_isExistID($nilai, $dekripenID)){
		echo json_encode(array('error'=> true, 'msg'=> "ID Status sudah terpakai ..."));
		return ;
	}
	
	$ex = debot_add($nilai, $dekripenID, $desc);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'debot-update'){
	$dekripenID = $_POST['dekripenID'];
	$nilai = intval($_POST['nilai']);
	$desc = $_POST['desc'];
	
	//normalisasi bobot
	$nilai = $nilai<0? 0 : $nilai;
	$nilai = $nilai>100? 100 : $nilai;
	
	$ex = debot_update($nilai, $dekripenID, $desc);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'debot-delete'){
	$dekripenID = $_POST['dekripenID'];
	$nilai = $_POST['nilai'];
	$ex = debot_delete($nilai, $dekripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}