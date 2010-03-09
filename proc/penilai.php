<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include_once '../model/karyawan.php';
include_once '../model/departemen.php';
include_once '../model/penilai.php';
include_once '../model/periode.php';
include_once '../model/bobotLevel.php';

$proc = $_REQUEST['proc'];

if ($proc==='searchKary-modal'){
	include '../view/admin/penilai/penilai_searchKary-1.php';
}

if ($proc==='searchKary-table'){
	$searchKey = $_POST['searchKey'];
	$departemenID = $_POST['departemenID'];
	include '../view/admin/penilai/penilai_searchKaryTableList-1.php';
}

if ($proc==='jbt-combo'){
	$karyID = $_POST['karyID'];
	include '../view/admin/penilai/penilai_jabatanCombo.php';
}

if ($proc==='level-depth'){
	$periodeID = $_POST['periodeID'];
	$res = bobotlv_select(false, $periodeID);
	while ($ll = mysql_fetch_assoc($res)) {
		?><option value="<?=$ll['ID_LEVEL']?>"><?=$ll['NAMA_LEVEL']?></option>,<?php 
	}
}

if ($proc==='kary-dinilai-table'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	$departemenID = $_POST['departemenID'];
	include '../view/admin/penilai/penilai_tableList.php';
}

if ($proc==='kary-dinilai-table-konflik'){
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$periodeID = $_POST['periodeID'];
	$stsPenilaian = $_POST['stsPenilaian'];
	$departemenID = $_POST['departemenID'];
	include '../view/admin/penilai/penilai_konflik_tableList.php';
}

if ($proc==='penilai-save'){
	$state =  $_POST['state'];
	if ($state) { penilai_save(); }
	else { penilai_delete(); }
}

function penilai_delete(){
	$dinilaiID = $_POST['dinilaiID'];
    $dinilai_dep_div_jabID = $_POST['dinilai_dep_div_jabID'];
    $periodeID = $_POST['periodeID'];
    $levelID = $_POST['levelID']; 
    $penilaiID= $_POST['penilaiID'];
    $penilai_dep_div_jabID = $_POST['penilai_dep_div_jabID'];
    
	//delete nilai_per_penilai
	$penilaiTable = mysql_fetch_assoc( penilai_load($penilaiID, $penilai_dep_div_jabID) );
	$dinilaiTable = mysql_fetch_assoc( nilaiAkhir_load($dinilaiID, $dinilai_dep_div_jabID, $periodeID) );
	$bobotlvTable = mysql_fetch_assoc(bobotlv_load($periodeID, $levelID));
	$npp = mysql_fetch_assoc( npp_load($dinilaiTable['KODE_DINILAI'], $penilaiTable['KODE_PENILAI'], $bobotlvTable['ID_BOBOT_LEVEL']) );
	if ( npp_isExistID($npp['ID_NILAI_PER_PENILAI']) ){
		$ex = npp_delete($npp['ID_NILAI_PER_PENILAI']);
		if (!$ex) { 
			echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
			return; 
		}
	}
	
    //delete nilai akhir
    $na = mysql_fetch_assoc( nilaiAkhir_load($dinilaiID, $dinilai_dep_div_jabID, $periodeID) );
	if ( nilaiAkhir_isExistID($na['KODE_DINILAI']) ){
		$ex = nilaiAkhir_delete($na['KODE_DINILAI']);
		if (!$ex) { 
			echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
			return; 
		}
	}
	
	
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

function penilai_save(){
	$dinilaiID = $_POST['dinilaiID'];
    $dinilai_dep_div_jabID = $_POST['dinilai_dep_div_jabID'];
    $periodeID = $_POST['periodeID'];
    $levelID = $_POST['levelID']; 
    $penilaiID= $_POST['penilaiID'];
    $penilai_dep_div_jabID = $_POST['penilai_dep_div_jabID'];

	//save penilai
	if (! penilai_isExist($penilaiID, $penilai_dep_div_jabID)){
		if (! penilai_add($penilaiID, $penilai_dep_div_jabID) ) {
			echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		}
	}
	
	//save nilai akhir
	if (! nilaiAkhir_isExist($dinilaiID, $dinilai_dep_div_jabID, $periodeID)){
		if (! nilaiAkhir_add($dinilaiID, $dinilai_dep_div_jabID, $periodeID, 0.0) ) {
			echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		}
	}
	
	//save nilai_per_penilai
	$penilaiTable = mysql_fetch_assoc( penilai_load($penilaiID, $penilai_dep_div_jabID) );
	$dinilaiTable = mysql_fetch_assoc( nilaiAkhir_load($dinilaiID, $dinilai_dep_div_jabID, $periodeID) );
	$bobotlvID = mysql_fetch_assoc(bobotlv_load($periodeID, $levelID));
	$bobotlvID = $bobotlvID['ID_BOBOT_LEVEL'];
	if (! npp_isExist($dinilaiTable['KODE_DINILAI'], $penilaiTable['KODE_PENILAI'], $bobotlvID) ){
		if (! npp_insert($dinilaiTable['KODE_DINILAI'], $penilaiTable['KODE_PENILAI'], $bobotlvID, 0.0) ) {
			echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		}
	}
	echo json_encode(array('error'=> false, 'msg'=> mysql_innodb_error(mysql_errno())));
}
