<?php 
include 'lib/sessionCheck.php';

$p = $_GET['p'];

//cek tipe user
if ($_COOKIE_DATA->type == 1 && $_COOKIE_DATA->asAdmin){	//super user
	if ($p==='karyawan') { include 'view/admin/karyawan.php'; }
	else if ($p==='divisi') { include 'view/admin/divisi.php';	}
	else if ($p==='departemen') { include 'view/admin/departemen.php'; }
	else if ($p==='jabatan') { include 'view/admin/jabatan.php'; }
	else if ($p==='statusKaryawan') { include 'view/admin/statusKaryawan.php'; }
	else if ($p==='golongan') { include 'view/admin/golongan.php'; }
	else if ($p==='kriteriaPenilaian') { include 'view/admin/kriteriaPenilaian.php'; }
	else if ($p==='detilKriteriaPenilaian') { include 'view/admin/detilKriteriaPenilaian.php'; }
	else if ($p==='deskripsiBobot') { include 'view/admin/deskripsiBobot.php'; }
	else if ($p==='periode') { include 'view/admin/periode.php'; }
	else if ($p==='bobotLevel') { include 'view/admin/bobotLevel.php'; }
	else if ($p==='detilBobotLevel') { include 'view/admin/detilBobotLevel.php'; }
	else if ($p==='penilai') { include 'view/admin/penilai.php'; }
	else{include 'view/admin/dashboard.php'; }
}
else{
	if ($p==='penilaian') {
		include 'view/client/penilaian.php';
	}
	else{
		include 'view/client/dashboard.php';
	}
}
