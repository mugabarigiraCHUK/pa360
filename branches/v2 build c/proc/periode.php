<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/date.php';
include '../lib/utils/tag.php';
include '../model/periode.php';
include '../model/bobotLevel.php';

$proc = $_REQUEST['proc'];

/**
 * table periode
 */
if ($proc === 'periode-table'){
	$key = $_POST['key'];
	include '../view/admin/periode/tableList.php';
}

if ($proc === 'add-modal'){
	include '../view/admin/periode/periode_add.php';
}

if ($proc === 'edit-modal'){
	include '../view/admin/periode/periode_edit.php';
}

if ($proc === 'bobotLevel-modal'){
	$level = $_POST['level'];
	$periodeID = $_POST['periodeID'];
	include '../view/admin/periode/periode_bobotLevel.php';
}

if ($proc === 'periode-save'){
	$id = $_POST['periodeID'];
	$periodeAwal = $_POST['periodeAwal']===''? NULL : date("Y-m-d", $_POST['periodeAwal']);
	$periodeAkhir = $_POST['periodeAkhir']===''? NULL : date("Y-m-d", $_POST['periodeAkhir']);
	$bobotV = intval($_POST['bobotV']);
	$bobotH = intval($_POST['bobotH']);
	$lvV = intval($_POST['lvV']);
	$lvH = intval($_POST['lvH']);
	$batasAwal = $_POST['batasAwal']===''? NULL : date("Y-m-d", $_POST['batasAwal']);
	$batasAkhir = $_POST['batasAkhir']===''? NULL : date("Y-m-d", $_POST['batasAkhir']);
	
	if ($id == ''){
		echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Periode"));
		return ;
	}
	
	if (periode_isExistID($id)){
		echo json_encode(array('error'=> true, 'msg'=> "ID Periode telah terpakai"));
		return ;
	}
	
	$ex = periode_addComplete($id, $periodeAwal, $periodeAkhir, $bobotV, $bobotH, $lvV, 
						$lvH, $batasAwal, $batasAkhir);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'periode-edit'){
	$id = $_POST['periodeID'];
	$periodeAwal = $_POST['periodeAwal']===''? NULL : date("Y-m-d", $_POST['periodeAwal']);
	$periodeAkhir = $_POST['periodeAkhir']===''? NULL : date("Y-m-d", $_POST['periodeAkhir']);
	$bobotV = intval($_POST['bobotV']);
	$bobotH = intval($_POST['bobotH']);
	$lvV = intval($_POST['lvV']);
	$lvH = intval($_POST['lvH']);
	$batasAwal = $_POST['batasAwal']===''? NULL : date("Y-m-d", $_POST['batasAwal']);
	$batasAkhir = $_POST['batasAkhir']===''? NULL : date("Y-m-d", $_POST['batasAkhir']);
	
	$ex = periode_updateComplete($id, $periodeAwal,	$periodeAkhir, $bobotV, $bobotH, $lvV, $lvH,
					$batasAwal, $batasAkhir);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'periode-delete'){
	$id = $_POST['periodeID'];
	$ex = periode_delete_complete($id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}