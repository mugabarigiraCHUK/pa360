<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include_once '../lib/utils/tag.php';
include '../model/karyawan.php';
include '../model/departemen.php';
include '../model/penilai.php';
include '../model/periode.php';

$proc = $_REQUEST['proc'];

if ($proc==='searchKary-modal'){
	include '../view/admin/penilai/penilai_searchKary-1.php';
}

if ($proc==='searchKary-table'){
	$searchKey = $_POST['searchKey'];
	$departemenID = $_POST['departemenID'];
	include '../view/admin/penilai/penilai_searchKaryTableList-1.php';
}

if ($proc==='searchKary2-modal'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	$searchKey = $_POST['searchKey'];
	include '../view/admin/penilai/penilai_searchKary-2.php';
}

if ($proc==='searchKary2-table'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	$searchKey = $_POST['searchKey'];
	$departemenID = $_POST['departemenID'];
	include '../view/admin/penilai/penilai_searchKaryTableList-2.php';
}


if ($proc==='penilai-table'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	include '../view/admin/penilai/penilai_tableList.php';
}

if ($proc==='jbt-combo'){
	$karyID = $_POST['karyID'];
	include '../view/admin/penilai/penilai_jabatanCombo.php';
}

if ($proc==='level-depth'){
	$periodeID = $_POST['periodeID'];
	$rs = periode_load($periodeID);
	$rs = mysql_fetch_assoc($rs);
	?>
	<option value="HZ" level="<?=$rs['LEVEL_HORIZONTAL']?>">Horizontal</option>
	<option value="VC" level="<?=$rs['LEVEL_VERTIKAL']?>">Vertical</option><?php
}

if ($proc==='add-modal'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	include '../view/admin/penilai/penilai_add.php';
}

if ($proc==='penilai-save'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$levelID = $_POST['levelID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	$penilaiID = $_POST['penilaiID'];
	$dep_div_jabPenilaiID = $_POST['dep_div_jabPenilaiID'];
	
	/**
	 * save add ke PENILAI & NILAI_PER_PENILAI saja. dirasa sudah cukup sebagai reference.
	 */
	//insert PENILAI, ignore error
	@penilai_add($penilaiID, $periodeID, $dep_div_jabPenilaiID, $levelID, $stsPenilaian);
	//insert NILAI_PER_PENILAI
	$ex = npp_insert($karyID, $penilaiID, $periodeID, $dep_div_jabID, microtime(), $levelID, 0);
	
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc==='penilai-delete'){
	$nilaiPerPenilaiID = $_POST['nilaiPerPenilaiID'];
	
	//hapus dari table nilai_per_penilai
	$ex = npp_delete($nilaiPerPenilaiID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}
