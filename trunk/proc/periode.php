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
	$bobotV = intval($_POST['bobotV']);
	$bobotH = intval($_POST['bobotH']);
	$lvV = intval($_POST['lvV']);
	$lvH = intval($_POST['lvH']);
	$periodeAwal = $_POST['periodeAwal'];
	$periodeAkhir = $_POST['periodeAkhir'];
	$batasAwal = $_POST['batasAwal'];
	$batasAkhir = $_POST['batasAkhir'];
	$id = periode_genID($periodeAwal, $periodeAkhir);
	
	if ($id == ''){				 echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi ID Periode")); return ;}
	if (periode_isExistID($id)){ echo json_encode(array('error'=> true, 'msg'=> "ID Periode telah terpakai")); return ;}
	
	//check batas awal & akhir
	if (!$periodeAwal){ 			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal periode awal")); return ; }
	if (!$periodeAkhir){ 			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal periode akhir")); return ; }
	if ($periodeAkhir<$periodeAwal){echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas periode awal dan akhir")); return ; }
	if (!$batasAwal){ 				echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal penilaian awal")); return ; }
	if (!$batasAkhir){ 				echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal penilaian akhir")); return ; }
	if ($batasAkhir<$batasAwal){ 	echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas penilaian awal dan akhir")); return ; }
	if ($batasAwal<=$periodeAkhir || 
		$batasAkhir<=$periodeAkhir){ echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas periode dan batas penilaian")); return ; }
		
	//prepare on save, normalize date
	$periodeAwal = $periodeAwal===''? NULL : date("Y-m-d", $periodeAwal);
	$periodeAkhir = $periodeAkhir===''? NULL : date("Y-m-d", $periodeAkhir);
	$batasAwal = $_POST['batasAwal']===''? NULL : date("Y-m-d", $batasAwal);
	$batasAkhir = $_POST['batasAkhir']===''? NULL : date("Y-m-d", $batasAkhir);
	
	//periksa apakah tanggal periode awal sudah ter-cover pada data periode sebelumnya
	$coverage = periode_checkCoverage($periodeAwal);
	if ($coverage){	echo json_encode(array('error'=> true, 'msg'=> "Periode awal sudah tercover pada periode '$coverage'")); return ; }
	
	$ex = periode_addComplete($id, $periodeAwal, $periodeAkhir, $bobotV, $bobotH, $lvV, 
						$lvH, $batasAwal, $batasAkhir);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'periode-edit'){
	$id = $_POST['periodeID'];
	$bobotV = intval($_POST['bobotV']);
	$bobotH = intval($_POST['bobotH']);
	$lvV = intval($_POST['lvV']);
	$lvH = intval($_POST['lvH']);
	
	//check batas awal & akhir
	$periodeAwal = $_POST['periodeAwal'];
	$periodeAkhir = $_POST['periodeAkhir'];
	$batasAwal = $_POST['batasAwal'];
	$batasAkhir = $_POST['batasAkhir'];
	if (!$periodeAwal){ 			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal periode awal")); return ; }
	if (!$periodeAkhir){ 			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal periode akhir")); return ; }
	if ($periodeAkhir<$periodeAwal){echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas periode awal dan akhir")); return ; }
	if (!$batasAwal){ 				echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal penilaian awal")); return ; }
	if (!$batasAkhir){ 				echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi tanggal penilaian akhir")); return ; }
	if ($batasAwal<$batasAkhir){ 	echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas penilaian awal dan akhir")); return ; }
	if ($batasAwal<$periodeAkhir || 
		$batasAkhir<$periodeAkhir){ echo json_encode(array('error'=> true, 'msg'=> "Mohon cek ulang batas periode dan batas penilaian")); return ; }
	
	//prepare on save, normalize date
	$periodeAwal = $periodeAwal===''? NULL : date("Y-m-d", $periodeAwal);
	$periodeAkhir = $periodeAkhir===''? NULL : date("Y-m-d", $periodeAkhir);
	$batasAwal = $_POST['batasAwal']===''? NULL : date("Y-m-d", $batasAwal);
	$batasAkhir = $_POST['batasAkhir']===''? NULL : date("Y-m-d", $batasAkhir);
	
	$ex = periode_updateComplete($id, $periodeAwal,	$periodeAkhir, $bobotV, $bobotH, $lvV, $lvH,
					$batasAwal, $batasAkhir);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc === 'periode-delete'){
	$id = $_POST['periodeID'];
	$ex = periode_delete_complete($id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}