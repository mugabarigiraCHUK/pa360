<?php
$DEBOT = debotlv_select(false, false, $periodeID, $levelID, $kripenID);
$DEBOT = mysql_fetch_assoc($DEBOT);
$debotlvID = $DEBOT['ID_DETIL_BOBOT_LEVEL'];
$AVG = npkrt_avg($debotlvID);

$sqlc = "";
if ($constraint<0){	//di bawah rata2
	$sqlc = "NILAI<$AVG";
}
else{
	$sqlc = "NILAI>=$AVG";
}
$sqlc .= " AND ID_DETIL_BOBOT_LEVEL='$debotlvID'";
$NPKRT = npkrt_select2($sqlc);

$loop=0;
while ($row = mysql_fetch_assoc($NPKRT)):
	$loop++;
	
	//load nilai_per_penilai
	$nppID = $row['ID_NILAI_PER_PENILAI'];
	$NPP = mysql_fetch_assoc( npp_loadComplete("ID_NILAI_PER_PENILAI='$nppID'") );
	
	$KARY = mysql_fetch_assoc( kary_load($NPP['KODE_KARYAWAN_DINILAI']) );
?>
<tr>
	<td><?php echo $KARY['KODE_KARYAWAN']?></td>
	<td><?php echo $KARY['NAMA_KARYAWAN']?></td>
	<td align="right"><?php echo number_format($row['NILAI'], 2)?></td>
	<td></td>
</tr>	
<?php 
endwhile;

if ($loop==0):?>
<tr>
	<td colspan="3" align="center"><h3>No data</h3></td>
</tr><?php 
endif;