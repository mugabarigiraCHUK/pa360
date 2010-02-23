<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include '../../model/periode.php';
include '../../model/bobotLevel.php';
include '../../model/departemen.php';
include '../../model/nilaiPerPenilai.php';
include '../../model/nilaiAkhir.php';
include '../../model/karyawan.php';
include '../../model/misc.php';
include '../../model/grade.php';

$proc = $_REQUEST['proc'];

if ($proc === 'search-table'){
	$periodeID = $_POST['periodeID'];
	$departemenID = $_POST['departemenID'];
	$departemenID = $departemenID==-1 || $departemenID==='' || 
					$departemenID==='false' || $departemenID==false? false : $departemenID;
	include '../../view/admin/laporan_global/global_tableList.php';
}

if ($proc === 'departemen-avg'){
	$periodeID = $_POST['periodeID'];
	$departemenID = $_POST['departemenID'];
	$departemenID = $departemenID=="false" || $departemenID==""? false : $departemenID;
	echo number_format(nilaiAkhir_avg($periodeID, $departemenID),2);
}