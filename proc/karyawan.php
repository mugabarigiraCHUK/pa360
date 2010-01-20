<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include_once '../model/karyawan.php';
include_once '../model/statusKaryawan.php';
include_once '../model/dataUser.php';

$proc = $_REQUEST['proc'];

if ($proc==='kary-table'){
	$key = $_POST['key'];
	include '../view/admin/karyawan/tableList.php';
}

/**
 * modal untuk isi alamat
 */
if ($proc==='alamat-modal'){
	include '../view/admin/karyawan/kary_alamat.php';
}

/**
 * list untuk alamat table
 */
if ($proc === 'alamat-list'){
	$trID = $_REQUEST['id'];
	$alamat = $_REQUEST['alamat'];
	$kodePos = $_REQUEST['kodePos'];
	$kodeArea = $_REQUEST['kodeArea'];
	$kota = $_REQUEST['kota'];
	$propinsi = $_REQUEST['propinsi'];
	include '../view/admin/karyawan/kary_alamatList.php';
}

if ($proc==='alamat-list-delete'){
	$alamatID = $_REQUEST['alamatID'];
	$karyID = $_REQUEST['karyID'];
	$ex = alamat_delete($alamatID, $karyID);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

/**
 * list untuk tlp
 */
if ($proc === 'tlp-list'){
	$trID = $_REQUEST['id'];
	$tlp = $_REQUEST['tlp'];
	include '../view/admin/karyawan/kary_tlpList.php';
}

if ($proc==='tlp-list-delete'){
	$tlpID = $_REQUEST['tlpID'];
	$karyID = $_REQUEST['karyID'];
	if (tlp_isExistID($tlpID)){
		$ex = tlp_delete($tlpID, $karyID);	
	}
	else{
		$ex=true;
	}
	
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

/**
 * modal untuk isi tlp
 */
if ($proc==='tlp-modal'):
	$title = $_REQUEST['title'];	
?>
	<form name="formTlp">
	<h2 class="dialog_title"><span><?=$title?></span></h2>
	<div class="dialog_content" style="padding: 10px 20px">
	<table width="357" border="0" cellpadding="5" cellspacing="0">
		<tr>
			<td>
			<div align="right">Telepon :</div>
			</td>
			<td><label> <input type="text" name="tlp" onKeypress='keypress(event)'> </label></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" name="save" value="Save" onclick="tlp_save()"></td>
		</tr>
	</table>
	</div>
	</form>
<?php 
endif;

if ($proc === 'job-modal'){
	include '../model/departemen.php';
	include '../model/divisi.php';
	include '../model/jabatan.php';
	include '../view/admin/karyawan/kary_job.php';
}

if ($proc === 'job-list'){
	$trID = $_POST['trID'];
	$depID = $_POST['depID'];
	$divID = $_POST['divID'];
	$jabID = $_POST['jabID'];
	$tglMenjabat = $_POST['tglMenjabat'];
	$tglBerhenti = $_POST['tglBerhenti'];
	include '../model/departemen.php';
	include '../model/divisi.php';
	include '../model/jabatan.php';
	include '../view/admin/karyawan/kary_jobList.php';
}

if ($proc==='job-list-delete'){
	$dep_div_jabID = $_REQUEST['dep_div_jabID'];
	$karyID = $_REQUEST['karyID'];
	$ex = RELASIDIVJABDIN_delete($karyID, $dep_div_jabID) && 
			DEPDIVJAB_delete($dep_div_jabID);
	echo json_encode(array('error'=> !$ex, 'msg'=> print_r($_REQUEST, true)));//mysql_error()
}

if ($proc === 'gol-modal'){
	include '../model/golongan.php';
	include '../view/admin/karyawan/kary_gol.php';
}

if ($proc === 'gol-list'){
	$trID = $_POST['trID'];
	$golID = $_POST['golID'];
	$tglMenjabat = $_POST['tglMenjabat'];
	$tglBerhenti = $_POST['tglBerhenti'];
	include '../model/golongan.php';
	include '../view/admin/karyawan/kary_golList.php';
}
//
//if ($proc === 'stskary-add-modal'){
//	$karyID = $_POST['karyID'];
//	include '../view/admin/karyawan/kary_status.php';
//}
//
//if ($proc === 'stskary-list'){
//	$karyID = $_POST['karyID'];
//	include '../view/admin/karyawan/kary_statusList.php';
//}
//
//if ($proc === 'stskary-list-table'){
//	$karyID = $_POST['karyID'];	
//	include '../view/admin/karyawan/kary_statusListTable.php';
//}
//
//if ($proc === 'stskary-save'){
//	$karyID = $_POST['karyID'];
//	$stskaryID = $_POST['stskaryID'];
//	$tglUpdate = date("Y-m-d H:i:s", time());
//	$ex = detilStatusKaryawan_add($karyID, $stskaryID, $tglUpdate);
//	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
//}
//
//if ($proc === 'stskary-delete'){
//	$karyID = $_POST['karyID'];
//	$stskaryID = $_POST['stskaryID'];
//	$tglUpdate = $_POST['tglUpdate'];
//	$ex = detilStatusKaryawan_delete($karyID, $stskaryID, $tglUpdate);
//	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
//}

if ($proc === 'jbtKary-list'){
	$karyID = $_POST['karyID'];
	include '../view/admin/karyawan/kary_jbtList.php';
}

/**
 * save karyawan
 */
if ($proc==='karyawan-save'){
	$kode = $_POST['kode'];
	
	//validate the code
	if ($kode === '' || is_null($kode)){
		echo json_encode(array('error'=> true, 'msg'=> 'Kode Karyawan kosong !!!'));
		return;
	}
	
	if (kary_isExistCode($kode)){
		echo json_encode(array('error'=> true, 'msg'=> 'Kode karyawan terpakai !!!'));
		return;
	}
	
	//validasi email
	if (!preg_match('/^[A-Za-z0-9\.-@]+$/', $_POST['email'])){
	   	echo json_encode(array('error'=> true, 'msg'=> 'Format email tidak valid !!!'));
		return;
	}
	
	/*
	 * layout KARYAWAN
	 */
	$karyawanClean = array(
		'kode'		=> $kode,
		'nama' 		=> $_POST['nama'],
		'tmLahir' 	=> $_POST['tmLahir'],
		'tglLahir' 	=> $_POST['tglLahir']===''? NULL : date("Y-m-d", $_POST['tglLahir']),
		'kelamin' 	=> $_POST['kelamin'],
		'darah' 	=> $_POST['darah'],
		'email' 	=> $_POST['email'],
		'status' 	=> $_POST['status'],
		'agama' 	=> $_POST['agama'],
		'tglMasuk' 	=> $_POST['tglMasuk']===''? NULL : date("Y-m-d", $_POST['tglMasuk']),
		'tglKeluar' => $_POST['tglKeluar']===''? NULL : date("Y-m-d", $_POST['tglKeluar']),
		'statusKerja' => $_POST['statusKerja']
	);
	
	/*
	 * layout alamat dulu
	 * bikin kaya
	 * array (
	 * 		alamat=>,
	 *  	kodePos=>,
	 *  	kodeArea=>,
	 *  	kota=>,
	 *  	propinsi=>,
	 * )
	 */
	$alamat = $_POST['alamatArr'];
	$alamatClean = array();
	if (is_array($alamat)){
		foreach($alamat as $tkey){
			$tkey['kodePos'] = intval($tkey['kodePos']);
			$tkey['kodeArea'] = intval($tkey['kodeArea']); 
			$alamatClean[] = $tkey;
		}
	}
	
	/*
	 * layout tlp dulu
	 * array (
	 * 		[0]=>
	 * 		[1]=>
	 * )
	 */
	$tlp = $_POST['tlpArr'];
	$tlpClean = array();
	if (is_array($tlp)){
		foreach($tlp as $tt){
			$tlpClean[] = intval($tt);
		}
	}
	
	/*
	 * layout relasi DEP_DIVISI_JABATAN
	 * array (
	 * 		'jabatan'		=>
	 * 		'divisi'		=>
	 * 		'departemen'	=>
	 * 		'tglMenjabat'	=>
	 * 		'tglBerhenti'	=>
	 * )
	 */
	$job = $_POST['jobArr'];
	$jobClean = array();
	if (is_array($job)){
		foreach($job as $tkey){
			$tkey['tglMenjabat'] = $tkey['tglMenjabat']===''? NULL : date("Y-m-d", $tkey['tglMenjabat']);
			$tkey['tglBerhenti'] = $tkey['tglBerhenti']===''? NULL : date("Y-m-d", $tkey['tglBerhenti']);
			$jobClean[] = $tkey;
		}
	}
	
	/*
	 * layout relasi RELASI_GOLONGAN
	 * array (
	 * 		'golongan'		=>
	 * 		'tglMenjabat'	=>
	 * 		'tglBerhenti'	=>
	 * )
	 */
	$gol = $_POST['golArr'];
	$golClean = array();
	if (is_array($gol)){
		foreach($gol as $tkey){
			$tkey['tglMenjabat'] = $tkey['tglMenjabat']===''? NULL : date("Y-m-d", $tkey['tglMenjabat']);
			$tkey['tglBerhenti'] = $tkey['tglBerhenti']===''? NULL : date("Y-m-d", $tkey['tglBerhenti']);
			$golClean[] = $tkey;
		}
	}
	
	//insert the data
	$ex = kary_insert_complete($karyawanClean, $alamatClean, $tlpClean, $jobClean, $golClean);
	
	//pass the message
//	echo json_encode(array('error'=> true, 'msg'=> print_r($_POST, true)));
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
	
	//add data_user
	user_insert($kode, md5($kode));
}

/**
 * update karyawan
 */
if ($proc==='karyawan-update'){
	$kode = $_POST['kode'];
		
	//validasi email
	if (!preg_match('/^[A-Za-z0-9\.-@]+$/', $_POST['email'])){
	   // character not valid in domain part
	   $isValid = false;
	   	echo json_encode(array('error'=> true, 'msg'=> 'Format email tidak valid !!!'));
		return;
	}
	
	/*
	 * layout KARYAWAN
	 */
	$karyawanClean = array(
		'kode'		=> $kode,
		'nama' 		=> $_POST['nama'],
		'tmLahir' 	=> $_POST['tmLahir'],
		'tglLahir' 	=> $_POST['tglLahir']===''? NULL : date("Y-m-d", $_POST['tglLahir']),
		'kelamin' 	=> intval($_POST['kelamin']),
		'darah' 	=> $_POST['darah'],
		'email' 	=> $_POST['email'],
		'status' 	=> $_POST['status'],
		'agama' 	=> $_POST['agama'],
		'tglMasuk' 	=> $_POST['tglMasuk']===''? NULL : date("Y-m-d", $_POST['tglMasuk']),
		'tglKeluar' => $_POST['tglKeluar']===''? NULL : date("Y-m-d", $_POST['tglKeluar']),
		'statusKerja' => $_POST['statusKerja']
	);
	
	/*
	 * layout alamat dulu
	 * bikin kaya
	 * array (
	 * 		alamat=>,
	 *  	kodePos=>,
	 *  	kodeArea=>,
	 *  	kota=>,
	 *  	propinsi=>,
	 * )
	 */
	$alamat = $_POST['alamatArr'];
	$alamatClean = array();
	if (is_array($alamat)){
		foreach($alamat as $tkey){
			$tkey['kodePos'] = intval($tkey['kodePos']);
			$tkey['kodeArea'] = intval($tkey['kodeArea']); 
			$alamatClean[] = $tkey;
		}
	}
	
	/*
	 * layout tlp dulu
	 * array (
	 * 		[0]=>
	 * 		[1]=>
	 * )
	 */
	$tlp = $_POST['tlpArr'];
	$tlpClean = array();
	if (is_array($tlp)){
		foreach($tlp as $tt){
			$tlpClean[] = intval($tt);
		}
	}
	
	/*
	 * layout relasi DEP_DIVISI_JABATAN
	 * array (
	 * 		'jabatan'		=>
	 * 		'divisi'		=>
	 * 		'departemen'	=>
	 * 		'tglMenjabat'	=>
	 * 		'tglBerhenti'	=>
	 * )
	 */
	$job = $_POST['jobArr'];
	$jobClean = array();
	if (is_array($job)){
		foreach($job as $tkey){
			$tkey['tglMenjabat'] = $tkey['tglMenjabat']===''? NULL : date("Y-m-d", $tkey['tglMenjabat']);
			$tkey['tglBerhenti'] = $tkey['tglBerhenti']===''? NULL : date("Y-m-d", $tkey['tglBerhenti']);
			$jobClean[] = $tkey;
		}
	}
	
	/*
	 * layout relasi RELASI_GOLONGAN
	 * array (
	 * 		'golongan'		=>
	 * 		'tglMenjabat'	=>
	 * 		'tglBerhenti'	=>
	 * )
	 */
	$gol = $_POST['golArr'];
	$golClean = array();
	if (is_array($gol)){
		foreach($gol as $tkey){
			$tkey['tglMenjabat'] = $tkey['tglMenjabat']===''? NULL : date("Y-m-d", $tkey['tglMenjabat']);
			$tkey['tglBerhenti'] = $tkey['tglBerhenti']===''? NULL : date("Y-m-d", $tkey['tglBerhenti']);
			$golClean[] = $tkey;
		}
	}
	
	//insert the data
	$ex = kary_update_complete($karyawanClean, $alamatClean, $tlpClean, $jobClean, $golClean);
	
	//pass the message
//	echo json_encode(array('error'=> true, 'msg'=> print_r($_POST, true)));
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc==='karyawan-delete'){
	$kode = $_POST['kary_id'];
	$ex = kary_delete($kode);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

/**
 * search karyawan modal
 */
if ($proc==='karyawan-search'):
?>
<form name="formPencarianKary">
<h2 class="dialog_title"><span>Pencarian Karyawan</span></h2>
<div class="dialog_content" style="padding: 10px 20px">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="150" valign="top">Kunci Pencarian : </td>
		<td width="703"><input type="text" name="key" style="width:85%" onkeyup="search_go(this)"></td>
	</tr>
</table>
<table style="border:1px solid #457A3F;" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr class="header">
    <th width="10%"><h3><span class="colorWhite">Kode</span></h3></th>
    <th width="60%"><h3><span class="colorWhite">Nama</span></h3></th>
    <th width="30"><h3><span class="colorWhite">Tgl Masuk</span></h3></th>
  </tr>
  <tbody id="karyawan-search-table" style="overflow:scroll; overflow-x:hidden; height:250px;">
  <?php $result = kary_search('');?>
  <?php while ($row = mysql_fetch_assoc($result)):?>
  <tr <?=tag_zebra($z++)?> ondblclick="search_pick('<?= $row["KODE_KARYAWAN"] ?>')" style="cursor:pointer; height:25px">
    <td align="center"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
    <td align="center"><?= date('d-m-Y',strtotime($row["TANGGAL_MASUK"])) ?></td>
  </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Close"
	name="close" onclick="FBModal_hide()" /></div>
</form>
<?php 
endif;

/**
 * search karyawan modal
 */
if ($proc==='karyawan-search-list'):
	$key = $_GET['key'];
	$result = kary_search($key);
	while ($row = mysql_fetch_assoc($result)):
?>
  <tr bgcolor="white" ondblclick="search_pick('<?= $row["KODE_KARYAWAN"] ?>')" style="cursor:pointer;">
    <td align="center"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
    <td align="center"><?= $row["TANGGAL_MASUK"] ?></td>
  </tr>
<?php 
	endwhile;
endif;
?>