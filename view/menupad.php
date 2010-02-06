<?php
$p = $_GET['p'];
$pad = "";
if ($_COOKIE_DATA->type == 1 && $_COOKIE_DATA->asAdmin){	//super user
	if ($p==='karyawan' || $p==='divisi' || $p==='departemen' || $p==='jabatan' || 
		$p==='statusKaryawan' || $p==='golongan'){
		$pad = "Master :: Karyawan :: ".ucfirst($p);
			
	}
	else if ($p==='penilai' || $p==='kriteriaPenilaian' || 
		$p==='detilKriteriaPenilaian' || $p==='deskripsiBobot' || $p==='periode') {  
		$pad = "Master :: Metode :: ".ucfirst($p);
	}
	else if ($p==='bobotLevel' || $p==='detilBobotLevel') { 
		$pad = "Transaksi :: ".ucfirst($p);
	}
	else if ($p==='nilaiAkhir' || $p==='laporan_global' || $p==='laporan_detil' || 
		$p==='laporan_periodeGraph' || $p==='laporan_departemenGraph' || 
		$p==='laporan_rataKinerjaGraph' || $p==='laporan_karyawanGraph') { 
		$pad = "Laporan :: ".ucfirst($p);
	}
	else if ($p==='dataUser'){ 
		$pad = "User Privillage"; 
	}
	else{
		$pad = "Dashboard";
	}
}
else{
	if ($p==='penilaian') {
		$pad = "Penilaian"; 
	}
	elseif ($p==='detilPenilaian') {
		$pad = "Detil Penilaian"; 
	}
	else{
		$pad = "Dashboard"; 
	}
}
?>
<h4 style="display: inline;">PAGE : </h4> <?php echo $pad?>