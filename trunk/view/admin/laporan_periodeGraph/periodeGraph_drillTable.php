<?php
$AVG = nilaiAkhir_avg($periodeID);
$AVG = $AVG['AVG'];

$sqlc = "";
if ($constraint<0){	//di bawah rata2
	$sqlc = "NILAI_AKHIR<$AVG";
}
else{
	$sqlc = "NILAI_AKHIR>$AVG";
}
$sqlc .= " AND ID_PERIODE='$periodeID'";
$NA = nilaiAkhir_select0($sqlc, "KODE_KARYAWAN");

$loop=0;
while ($row = mysql_fetch_assoc($NA)):
	$loop++;
	$KARY = mysql_fetch_assoc( kary_load($row['KODE_KARYAWAN']) );
?>
<tr>
	<td><?php echo $KARY['KODE_KARYAWAN']?></td>
	<td><?php echo $KARY['NAMA_KARYAWAN']?></td>
	<td align="right"><?php echo number_format($row['NILAI_AKHIR'], 2)?></td>
	<td></td>
</tr>	
<?php 
endwhile;

if ($loop==0):?>
<tr>
	<td colspan="3" align="center"><h3>No data</h3></td>
</tr><?php 
endif;