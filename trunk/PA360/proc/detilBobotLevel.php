<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/periode.php';
include '../model/kriteriaPenilaian.php';
include '../model/bobotLevel.php';
include '../model/detilBobotLevel.php';

$proc = $_REQUEST['proc'];

if ($proc === 'debotlv-comboBobotLevel'){
	$periodeID = $_POST['periodeID'];
	include '../view/admin/detilBobotLevel/debotlv_comboBobotLevel.php';
}

if ($proc === 'debotlv-table'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	include '../view/admin/detilBobotLevel/debotlv_table.php';
}

if ($proc === 'debotlv-kripen-table'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	include '../view/admin/detilBobotLevel/debotlv_add_tableList.php';
}

if ($proc === 'add-modal'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	include '../view/admin/detilBobotLevel/debotlv_add.php';
}

if ($proc === 'debotlv-save'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	$kripenID = $_POST['kripenID'];
	
	$bobotTambahan = debotlv_load($periodeID,$levelID,$kripenID);
	$bobotTersimpan = debotlv_countBobot($periodeID, $levelID);
	if ($bobotTambahan + $bobotTersimpan > 100){
		echo json_encode(array('error'=> true, 'msg'=> "Bobot lebih dari 100%"));
	}
	
	$ex = debotlv_add($periodeID, $levelID, $kripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'debotlv-delete'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	$kripenID = $_POST['kripenID'];
	$ex = debotlv_delete($periodeID, $levelID, $kripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}


