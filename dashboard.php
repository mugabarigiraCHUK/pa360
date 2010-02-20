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
	else if ($p==='nilaiAkhir') { include 'view/admin/nilaiAkhir.php'; }
	else if ($p==='laporan_global') { include 'view/admin/laporan_global.php'; }
	else if ($p==='laporan_detil') { include 'view/admin/laporan_detil.php'; }
	else if ($p==='laporan_periodeGraph') { include 'view/admin/laporan_periodeGraph.php'; }
	else if ($p==='laporan_departemenGraph') { include 'view/admin/laporan_departemenGraph.php'; }
	else if ($p==='laporan_rataKinerjaGraph') { include 'view/admin/laporan_rataKinerjaGraph.php'; }
	else if ($p==='laporan_karyawanGraph') { include 'view/admin/laporan_karyawanGraph.php'; }
	else if ($p==='dataUser') { include 'view/admin/data_user.php'; }
	else if ($p==='grade') { include 'view/admin/grade.php'; }
	else{include 'view/admin/dashboard.php'; }
}
else{
	if ($p==='penilaian') {
		include 'view/client/penilaian.php';
	}
	elseif ($p==='detilPenilaian') {
		include 'view/client/detilPenilaian.php';
	}
	else{
		include 'view/client/dashboard.php';
	}
}
