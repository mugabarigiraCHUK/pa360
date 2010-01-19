<?php if ($_COOKIE_DATA->type == 1 && $_COOKIE_DATA->asAdmin): ?>
<ul id="navmenu-h">
	<li><a>Master + </a>
	<ul>
		<li><a>Master Karyawan + </a>
		<ul>
			<li><a href="dashboard.php?p=karyawan">Master Karyawan</a></li>
			<li><a href="dashboard.php?p=divisi">Master Divisi</a></li>
			<li><a href="dashboard.php?p=departemen">Master Department</a></li>
			<li><a href="dashboard.php?p=jabatan" onclick="">Master Jabatan</a></li>
			<li><a href="dashboard.php?p=statusKaryawan">Master Status</a></li>
			<li><a href="dashboard.php?p=golongan">Master Golongan</a></li>
		</ul>
		</li>
		<li><a>Master Metode + </a>
		<ul>
			<li><a href="dashboard.php?p=kriteriaPenilaian">Master Kriteria</a></li>
			<li><a href="dashboard.php?p=detilKriteriaPenilaian">Master Detail Kriteria</a></li>
			<li><a href="dashboard.php?p=deskripsiBobot">Master Deskripsi Bobot</a></li>
			<li><a href="dashboard.php?p=periode">Master Periode</a></li>
			<li><a href="dashboard.php?p=penilai">Master Penilai</a></li>
		</ul>
		</li>
	</ul>
	</li>

	<li><a>Transaksi</a>
	<ul>
		<li><a href="dashboard.php?p=bobotLevel">Setting Prosentase Penilaian</a></li>
		<li><a href="dashboard.php?p=detilBobotLevel">Setting Kriteria Penilaian</a></li>
	</ul>
	</li>

	<li><a>Laporan</a>
	<ul>
		<li><a href="dashboard.php?p=laporan_global">Laporan global</a></li>
		<li><a href="dashboard.php?p=laporan_detil">Laporan detail</a></li>
		<li><a href="dashboard.php?p=laporan_periodeGraph">Laporan grafik perperiode</a></li>
		<li><a href="dashboard.php?p=laporan_departemenGraph">Laporan grafik perdepartment</a></li>
		<li><a href="dashboard.php?p=laporan_rataKinerjaGraph">Laporan Grafik Jumlah karyawan nilai rata -rata</a></li>
		<li><a href="dashboard.php?p=laporan_karyawanGraph">Laporan Grafik PerKaryawan</a></li>
	</ul>
	</li>
	<li><a href="dashboard.php?p=dataUser">Users Privillage</a></li>
	<li><a href="lib/logout.php">Logout</a></li>
</ul>
<?php else: ?>
<ul id="navmenu-h">
	<li><a>Password Change</a></li>
	<li><a href="dashboard.php?p=penilaian">Performance Appraisal</a></li>
	<li><a href="lib/logout.php">Logout +</a></li>
</ul>
<?php endif; ?>