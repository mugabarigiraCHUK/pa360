<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/periode.php';
include '../model/kriteriaPenilaian.php';
include '../model/bobotLevel.php';
include '../model/detilBobotLevel.php';
include '../model/detilKriteriaPenilaian.php';

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

if ($proc === 'edit-modal'){
	$debotlvID = $_POST['debotlvID'];
	include '../view/admin/detilBobotLevel/debotlv_edit.php';
}

if ($proc === 'debotlv-pick'){
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	$kripenID = $_POST['kripenID'];
	
	//cek detil kriteria, jika jumlah detil kriterianya kurang dari 100%, pesan warning
	$sum = dekripen_summarize($kripenID);
	if ($sum<100){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Jumlah bobot detil kriteria kurang dari 100%"));
		return;
	}
	
	//load bobot level, ambil ID_BOBOT_LEVEL
	$bobotlv = mysql_fetch_assoc( bobotlv_load($periodeID, $levelID) );
	
	//simpan sementara, tanpa bobot.
	$ex = debotlv_add($kripenID, $bobotlv["ID_BOBOT_LEVEL"], 0);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'debotlv-delete'){
	$debotlvID = $_POST['debotlvID'];
	$ex = debotlv_delete($debotlvID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'debotlv-update'){
	$debotlvID = $_POST['debotlvID'];
	$kripenID = $_POST['kripenID'];
	$bobotlvID = $_POST['bobotlvID'];
	$bobot = intval($_POST['bobot']);
	
	//cari periode dan levelnya
	$data = mysql_fetch_assoc( debotlv_loadByID($debotlvID) );
	
	//hitung total bobotnya
	$total = debotlv_sumBobot($data["ID_PERIODE"], $data["ID_LEVEL"], $debotlvID);
	if ($total+$bobot<=100){
		$ex = debotlv_update($debotlvID, $kripenID, $bobotlvID, $bobot);
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));	
	}
	else{
		echo json_encode(array('error'=> true, 'msg'=> "Total melebihi 100%"));
	}
}


