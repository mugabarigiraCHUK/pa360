<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/karyawan.php';
include_once '../../model/dataUser.php';

$proc = $_REQUEST['proc'];

if ($proc == "change-password"){
	$karyID = $_POST['karyID'];
	include '../../view/client/changePassword.php';
}

if ($proc == "change-password-save"){
	$karyID = $_POST['karyID'];
	$opass = $_POST['opass'];
	$npass = $_POST['npass'];
	$npass2 = $_POST['npass2'];
	
	//check in database
	$sql = "SELECT * FROM data_user 
			WHERE user_nama='$karyID' 	
				AND user_password='$opass'";
	$sql = mysql_query($sql);
	$found = false;
	while ($row = mysql_fetch_assoc($sql)) { $found = true; }
	if (!$found){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Kombinasi password tidak sesuai..."));
		return;
	}
	
	//check kombinasi password baru
	if ($npass==md5("")){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Isi Password baru..."));
		return;
	}
	if ($npass!=$npass2){
		echo json_encode(array('error'=> TRUE, 'msg'=> "Samakan password baru..."));
		return;
	}
	
	//saving
	if (user_isExist($karyID)){
		$ex = user_update($karyID, $npass);
	}
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
}
