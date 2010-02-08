<?php
$AVG = nilaiAkhir_avg($periodeID, $departemenID);
$AVG = $AVG['AVG'];

//select departemen


$sqlc = "";
if ($constraint<0){	//di bawah rata2
	$sqlc = "NILAI_AKHIR<$AVG";
}
else{
	$sqlc = "NILAI_AKHIR>$AVG";
}
$sqlc .= " AND ID_PERIODE='$periodeID' AND ID_DEP_DIV_JAB IN (
			SELECT ID_DEP_DIV_JAB FROM dep_divisi_jabatan where ID_DEPARTMENT='$departemenID')";
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