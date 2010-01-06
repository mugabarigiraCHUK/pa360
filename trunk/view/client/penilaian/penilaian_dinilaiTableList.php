<?php 
//cari di table PENILAI, apa karyawan terpilih menjadi penilai
//$karyID == kode karyawan penilai
$rsPenilai = penilai_select($karyID, $periodeID);
$kary = array();
while ($row = mysql_fetch_assoc($rsPenilai)){
	//filter menurut id_dep_div_jab
	if ($row['ID_DEP_DIV_JAB']===$dep_div_jabID) {
		$kary[] = $row;
	}
}

//load data periode, ambil tanggal batas awal dan akhir penilaiannya
$rsPeriode = periode_load($periodeID);
$rsPeriode = mysql_fetch_assoc($rsPeriode);
$periode['awal'] = strtotime($rsPeriode['BATAS_AWAL_PENILAIAN']);
$periode['akhir'] = strtotime($rsPeriode['BATAS_AKHIR_PENILAIAN']);
?>
<?php foreach ($kary as $kk): ?>
	<?php $rs = npp_load3("a.PENILAI='".$kk['KODE_KARYAWAN']."' AND a.ID_PERIODE='".$kk['ID_PERIODE']."' AND a.ID_LEVEL='".$kk['ID_LEVEL']."'") ?>
	<?php while ($row = mysql_fetch_assoc($rs)):?>
	<tr <?=tag_zebra($z++)?>>
		<td><?=$row['NAMA_KARYAWAN']?></td>
		<td><?=$row['NAMA_JABATAN']?></td>
		<td><?=$row['NAMA_DEPARTMENT']?></td>
		<td><?=$row['NAMA_DIVISI']?></td>
		<td><?=$row['NAMA_LEVEL']?></td>
		<td><form id="frm<?=$z?>" name="frm<?=$z?>" action="dashboard.php?p=detilPenilaian" method="post">
			<input name="karyID" type="hidden" value="<?=$row['KODE_KARYAWAN']?>" />
			<input name="periodeID" type="hidden" value="<?=$row['ID_PERIODE']?>" />
			<input name="dep_div_jabID" type="hidden" value="<?=$row['ID_DEP_DIV_JAB']?>" />
			<input name="levelID" type="hidden" value="<?=$row['ID_LEVEL']?>" />
			<input name="nilaiPerPenilaiID" type="hidden" value="<?=$row['ID_NILAI_PER_PENILAI']?>" />
			<?php if ($periode['awal'] <= time() && $periode['akhir'] >= time()):?>
				<a onclick="$(this).getParent('form').submit()">
					<?php 
						//hitung apakah sudah ada data penilaian, 
						//jika belum statusnya "set nilai" jika sudah statusnya"update"
						$rsStatus = npkrt_select($row['KODE_KARYAWAN'], $karyID, $row['ID_PERIODE'], $row['ID_DEP_DIV_JAB'], false, $row['ID_LEVEL']);
						$stsCount = 0;
						while ($sts = mysql_fetch_assoc($rsStatus)){
							$stsCount++;
							echo 'update';
							break;
						}
						mysql_free_result($rsStatus);
						
						if ($stsCount<=0){
							echo 'set nilai';
						}
					?>
				</a>
			<?php endif;?>
			</form></td>
	</tr>
	<?php endwhile; ?>
	<?php mysql_free_result($rs);?>
<?php endforeach; ?>