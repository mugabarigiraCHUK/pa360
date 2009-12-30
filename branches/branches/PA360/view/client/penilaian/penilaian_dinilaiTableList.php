<?php 
//cari di table PENILAI, apa karyawan terpilih menjadi penilai
$rsPenilai = penilai_select($karyID, $periodeID);
$kary = array();
while ($row = mysql_fetch_assoc($rsPenilai)){
	//filter menurut id_dep_div_jab
	if ($row['ID_DEP_DIV_JAB']===$dep_div_jabID) {
		$kary[] = $row;
	}
}

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
		<td>&nbsp;</td>
	</tr>
	<?php endwhile; ?>
<?php endforeach; ?>