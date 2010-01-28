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

if ($proc === 'bobotLevel-table'){
	$periodeID = $_POST['periodeID'];
	include '../view/admin/bobotLevel/tableList.php';
}

if ($proc === 'kriteria-table'){
	$key = $_POST['key'];
	include '../view/admin/bobotLevel/kriteria_tableList.php';
}

if ($proc === 'edit-modal'){
	$bobotlvID = $_POST['bobotlvID'];
	include '../view/admin/bobotLevel/bobotlv_edit.php';
}

if ($proc === 'kriteria-modal'){
	$periodeID = $periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	include '../view/admin/bobotLevel/choose_kriteria.php';
}

if ($proc === 'bobotLevel-update'){
	$bobotlvID = $_POST['bobotlvID'];
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	$desc = $_POST['desc'];
	$bobot = $_POST['bobot'];
	
	//hitung bobot level
	$SUM = bobotlv_sum($periodeID, $levelID);
	if ($SUM + $bobot > 200){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Jumlah Bobot Horizontal + Vertikal melebihi batas..."));
	}
	else{
		$ex = bobotlv_update($bobotlvID, $periodeID, $levelID, $desc, $bobot);
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
	}
}