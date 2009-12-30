<?php if ($karyID===''):?>
<tr <?=tag_zebra($z++)?>>
	<td colspan="5" align="center">
		<h3>Pilih Karyawan, <a class="fake" onclick="penilai_searchKary_modal()">search</a>
		</h3>
	</td>
</tr>
<?php 	exit(); ?>
<?php endif;?>

<?php 
/**
 *	cari pada table NILAI_PER_PENILAI, jika ada lanjutkan dengan 
 *	mencari data pada table PENILAI yang sesuai dengan NILAI_PER_PENILAI.ID_KAYAWAN & NILAI_PER_PENILAI.ID_PERIODE
 */
//cari data pada table NILAI_PER_PENILAI
$res = npp_select("KODE_KARYAWAN='$karyID' AND 
					ID_PERIODE='$periodeID' AND 
					ID_DEP_DIV_JAB='$dep_div_jabID' AND 
					ID_LEVEL LIKE '%$stsPenilaian%'"); 
$data = array();
$z=0;
$dataCount=0;
while ($row = mysql_fetch_assoc($res)):
	
	//load data penilainya
	$rep = mysql_fetch_assoc( penilai_load($row['PENILAI'], $row['ID_PERIODE'], $row['ID_LEVEL']) );
?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$rep['ID_LEVEL']?></td>
	<td><?=$rep['NAMA_KARYAWAN']?></td>
	<td align="left"><?=$rep['NAMA_JABATAN']?></td>
	<td align="center"><?=$rep['STATUS_PENILAIAN']?></td>
	<td align="right"><a onclick="penilai_delete('<?=$row['ID_NILAI_PER_PENILAI']?>')">delete</a></td>
</tr>
<?php $dataCount++; ?>
<?php endwhile;?>
<?php 
	$rsperiode = mysql_fetch_assoc( periode_load($periodeID) );
	$levelDepth = $stsPenilaian==='HZ'? $rsperiode['LEVEL_HORIZONTAL'] : ($stsPenilaian==='VC'? $rsperiode['LEVEL_VERTIKAL'] : 0);
	
	if ($dataCount < $levelDepth):
?>			
<tr <?=tag_zebra($z++)?>>
	<td colspan="5" align="center"><h3>
		<?php if ($dataCount<=0): ?><span>No data, </span><?php endif; ?>
		<a class="fake" onclick="penilai_add($('frmSearch'))">add</a>
		</h3>
	</td>
</tr>
<?php endif;?>