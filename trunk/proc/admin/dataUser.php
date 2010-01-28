<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/karyawan.php';
include_once '../../model/dataUser.php';

$proc = $_REQUEST['proc'];

if ($proc == "kary-table"){
	$key = $_POST['key'];
	include '../../view/admin/dataUser/tableList.php';
}

if ($proc == "change-password"){
	$karyID = $_POST['karyID'];
	include '../../view/admin/dataUser/changePassword.php';
}

if ($proc == "change-password-save"){
	$karyID = $_POST['karyID'];
	$npass = $_POST['npass'];
	$npass2 = $_POST['npass2'];
	
	if ($npass!=$npass2){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Samakan password..."));
		return;
	}
	
	//belum terdaftar
	if (user_isExist($karyID)){
		$ex = user_update($karyID, $npass);
	}
	else{
		$ex = user_insert($karyID, $npass);
	}
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}

if ($proc == "change-role-save"){
	$karyID = $_POST['karyID'];
	$state = $_POST['state'];
	$state = $state!=1? 2 : $state;
	
	if (user_isExist($karyID)){
		$userdata = mysql_fetch_assoc(user_load($karyID));
		$ex = user_update($karyID, $userdata['user_password'], $state);
	}
	else{
		$ex = user_insert($karyID, $npass, $state);
	}
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}