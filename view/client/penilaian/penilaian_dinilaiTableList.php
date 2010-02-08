<?php 
//cek apakah user terdaftar menjadi penilai
$isPenilai = penilai_isExist($karyID, $dep_div_jabID);

if (! $isPenilai){
?><tr><td align="center" colspan="6"><h3>No Data</h3></td></tr><?php 
	exit();
}
$penilaiTable = mysql_fetch_assoc( penilai_load($karyID, $dep_div_jabID) );
$penilaiID = $penilaiTable['KODE_PENILAI'];

//load data periode, ambil tanggal batas awal dan akhir penilaiannya
$rsPeriode = periode_load($periodeID);
$rsPeriode = mysql_fetch_assoc($rsPeriode);
$periode['awal'] = strtotime($rsPeriode['BATAS_AWAL_PENILAIAN']);
$periode['akhir'] = strtotime($rsPeriode['BATAS_AKHIR_PENILAIAN']);

//load nilai_per_penilai
$nppTable = mysql_query(
	"SELECT a.ID_NILAI_PER_PENILAI, 
		a.KODE_DINILAI,
		c.KODE_KARYAWAN AS KODE_KARYAWAN_DINILAI,
		c.ID_DEP_DIV_JAB AS ID_DEP_DIV_JAB_DINILAI,
		c.ID_PERIODE AS ID_PERIODE_DINILAI, 
		a.KODE_PENILAI, 
		a.ID_BOBOT_LEVEL, 
		b.ID_PERIODE,
		b.ID_LEVEL,
		a.NILAI
	FROM nilai_per_penilai AS a, 
		bobot_level AS b,
		nilai_akhir as c
	WHERE a.KODE_PENILAI = '$penilaiID'
		AND a.ID_BOBOT_LEVEL = b.ID_BOBOT_LEVEL
		AND a.KODE_DINILAI=c.KODE_DINILAI
		AND b.ID_PERIODE = '$periodeID'
	GROUP BY ID_NILAI_PER_PENILAI
	ORDER BY ID_LEVEL");

while ($kk = mysql_fetch_assoc($nppTable)):  
		//load semua data yang diperlukan
		$karyDinilaiID = $kk['KODE_KARYAWAN_DINILAI'];
		$depdivjabDinilaiID = $kk['ID_DEP_DIV_JAB_DINILAI'];
		$periodeDinilaiID = $kk['ID_PERIODE_DINILAI'];
		$NA = mysql_query(
		"SELECT a.KODE_KARYAWAN, a.NAMA_KARYAWAN, 
			b.ID_DEP_DIV_JAB, d.ID_DEPARTMENT, 
			d.NAMA_DEPARTMENT, e.ID_JABATAN, 
			e.NAMA_JABATAN, f.ID_DIVISI, f.NAMA_DIVISI
		FROM data_karyawan as a, 
		    relasi_div_jab_din as b,
		    dep_divisi_jabatan as c,
		    data_department as d,
		    data_jabatan as e,
		    data_divisi as f
		WHERE 
		    a.KODE_KARYAWAN=b.KODE_KARYAWAN
		    AND b.ID_DEP_DIV_JAB=c.ID_DEP_DIV_JAB
		    AND c.ID_DEPARTMENT=d.ID_DEPARTMENT
		    AND c.ID_JABATAN=e.ID_JABATAN
		    AND c.ID_DIVISI=f.ID_DIVISI
			AND a.KODE_KARYAWAN='$karyDinilaiID'
			AND b.ID_DEP_DIV_JAB='$depdivjabDinilaiID'");
?>
<?php 	while ($row = mysql_fetch_assoc($NA)):?>
	<tr <?=tag_zebra($z++)?>>
		<td><?=$row['NAMA_KARYAWAN']?></td>
		<td><?=$row['NAMA_JABATAN']?></td>
		<td><?=$row['NAMA_DEPARTMENT']?></td>
		<td><?=$row['NAMA_DIVISI']?></td>
		<td align="center"><?=$kk['ID_LEVEL']?></td>
		<td width="80px"><form id="frm<?=$z?>" name="frm<?=$z?>" action="dashboard.php?p=detilPenilaian" method="post">
			<input name="karyID" type="hidden" value="<?=$row['KODE_KARYAWAN']?>" />
			<input name="periodeID" type="hidden" value="<?=$kk['ID_PERIODE']?>" />
			<input name="dep_div_jabID" type="hidden" value="<?=$row['ID_DEP_DIV_JAB']?>" />
			<input name="levelID" type="hidden" value="<?=$kk['ID_LEVEL']?>" />
			<input name="nilaiPerPenilaiID" type="hidden" value="<?=$kk['ID_NILAI_PER_PENILAI']?>" />
			<?php //if ($periode['awal'] <= time() && $periode['akhir'] >= time()):?>
				<a onclick="$(this).getParent('form').submit()">
					<?php 
						//hitung apakah sudah ada data penilaian, 
						$stsCount = $kk['NILAI'];
						echo $stsCount<=0? "set nilai" : "update nilai";
					?>
				</a>
			<?php //endif;?>
			</form>
		</td>
	</tr>
	<?php endwhile; ?>
	<?php mysql_free_result($NA);?>
<?php endwhile; ?>