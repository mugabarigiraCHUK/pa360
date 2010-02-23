<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/karyawan.php';
include_once '../../model/departemen.php';
include_once '../../model/bobotLevel.php';
include_once '../../model/detilBobotLevel.php';
include_once '../../model/periode.php';
include_once '../../model/kriteriaPenilaian.php';
include_once '../../model/detilKriteriaPenilaian.php';
include_once '../../model/misc.php';
include_once '../../model/grade.php';
include_once '../../model/penilai.php';

$proc = $_REQUEST['proc'];

if ($proc==='jbt-combo'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	include '../../view/admin/laporan_detil/detil_jabatanCombo.php';
}

if ($proc==='searchKary-modal'){
	include '../../view/admin/laporan_detil/detil_searchKary.php';
}

if ($proc==='searchKary-table'){
	$searchKey = $_POST['searchKey'];
	$departemenID = $_POST['departemenID'];
	include '../../view/admin/laporan_detil/detil_searchKaryTable.php';
}

if ($proc==='search-table'){
	$karyID=$_POST['karyID'];
	$periodeID=$_POST['periodeID'];
	$departemenID=$_POST['departemenID'];
	$dep_div_jabID=$_POST['dep_div_jabID'];
	if ($karyID=="" || !$karyID) return;
	include '../../view/admin/laporan_detil/detil_tableList.php';
}