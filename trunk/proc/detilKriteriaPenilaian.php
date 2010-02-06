<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/kriteriaPenilaian.php';
include '../model/detilKriteriaPenilaian.php';
include '../model/detilBobotLevel.php';

$proc = $_REQUEST['proc'];

if ($proc === 'search-modal'){
	include '../view/admin/detilKriteriaPenilaian/search.php';
}

/**
 * row table untuk 
 */
if ($proc === 'dekripen-table'){
	$key = $_POST['key'];
	$kripenID = $_POST['kripenID'];
	include '../view/admin/detilKriteriaPenilaian/tableList.php';
}

/**
 * modal untuk add divisi
 */
if ($proc === 'add-modal'){
	$kripenID = $_POST['kripenID'];
	include '../view/admin/detilKriteriaPenilaian/dekripen_add.php';
} 

/**
 * modal untuk update divisi
 */
if ($proc === 'edit-modal'){
	$dekripenID = $_POST['dekripenID'];
	$dekripenData = mysql_fetch_assoc( dekripen_load($dekripenID) );
	$kripenID = $dekripenData['ID_KRITERIA'];
	if (debotlv_kripenIsExist($kripenID)){
		echo json_encode(array('error'=> true, 'msg'=> "Referensi data terpakai, proses edit tidak diperbolehkan"));
		return false;
	}
	include '../view/admin/detilKriteriaPenilaian/dekripen_edit.php';
}

if ($proc == 'dekripen-save'){
	$kripenID = $_POST['kripenID'];
	$dekripenID = $_POST['dekripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$bobot = $_POST['bobot'];
	
	//normalisasi bobot
	$bobot = $bobot<0? 0 : $bobot;
	$bobot = $bobot>100? 100 : $bobot;
	
	$sum = dekripen_summarize($kripenID);
	if ($sum + $bobot>100){
		echo json_encode(array('error'=> true, 'msg'=> "total bobot detil kriteria lebih dari 100%, mohon cek ulang ..."));
		return ;
	}
	
	$ex = dekripen_add($kripenID, $dekripenID, $nama, $desc, $bobot);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'dekripen-update'){
	$kripenID = $_POST['kripenID'];
	$dekripenID = $_POST['dekripenID'];
	$nama = $_POST['nama'];
	$desc = $_POST['desc'];
	$bobot = $_POST['bobot'];
	
	//normalisasi bobot
	$bobot = $bobot<0? 0 : $bobot;
	$bobot = $bobot>100? 100 : $bobot;
	
	$sum = dekripen_summarize($kripenID, $dekripenID);
	if ($sum + $bobot>100){
		echo json_encode(array('error'=> true, 'msg'=> 
			"Total bobot kriteria lebih dari 100% (". ($sum + $bobot) ."), mohon cek ulang ... "));
		return ;
	}
	
	$ex = dekripen_update($kripenID, $dekripenID, $nama, $desc, $bobot);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'dekripen-delete'){
	$dekripenID = $_POST['dekripenID'];
	$ex = dekripen_delete($dekripenID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}