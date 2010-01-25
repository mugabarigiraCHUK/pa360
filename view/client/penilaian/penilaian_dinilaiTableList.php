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
		$bobotlvID = $kk['ID_BOBOT_LEVEL'];
		$KARY = kary_load_complete($karyDinilaiID);	
		$JAB = array();
			
		//cari jabatan
		foreach($KARY['JABATAN'] as $jj){
			if ($jj['ID_DEP_DIV_JAB']==$depdivjabDinilaiID){
				$JAB=$jj; break;
			}
		}
?>
	<tr <?=tag_zebra($z++)?>>
		<td><?=$KARY['NAMA_KARYAWAN']?></td>
		<td><?=$JAB['NAMA_JABATAN']?></td>
		<td><?=$JAB['NAMA_DEPARTMENT']?></td>
		<td><?=$JAB['NAMA_DIVISI']?></td>
		<td><?=$kk['ID_LEVEL']?></td>
		<td><form id="frm<?=$z?>" name="frm<?=$z?>" action="dashboard.php?p=detilPenilaian" method="post">
			<input name="kodeDinilai" type="hidden" value="<?=$kk['KODE_DINILAI']?>" />
			<?php if ($periode['awal'] <= time() && $periode['akhir'] >= time()):?>
				<a onclick="$(this).getParent('form').submit()">
					<?php 
						//hitung apakah sudah ada data penilaian, 
						//jika belum statusnya "set nilai" jika sudah statusnya"update"
						$rsStatus = mysql_query(
							"SELECT count(a.ID_NILAI_PER_KRITERIA) as COUNT
							FROM nilai_per_kriteria as a, 
								detil_bobot_level as b, 
								nilai_per_penilai as c
							WHERE a.ID_NILAI_PER_PENILAI=c.ID_NILAI_PER_PENILAI 
								AND a.ID_DETIL_BOBOT_LEVEL=b.ID_DETIL_BOBOT_LEVEL
								AND c.KODE_DINILAI='$karyDinilaiID'
								AND b.ID_BOBOT_LEVEL='$bobotlvID'");
						$sts = mysql_fetch_assoc($rsStatus);
						$stsCount = intval($sts['COUNT']);
						echo $stsCount<=0?'set nilai' : 'update';
					?>
				</a>
			<?php endif;?>
			</form></td>
	</tr>
<?php endwhile; ?>