<?php 
if ($golID=="") exit();
?>
<?php $res = mysql_fetch_assoc(golongan_load($golID)); ?>
<tr id="<?php echo $trID?>" bgcolor="#FFFFFF">
	<td align="center"><?php echo $res['NAMA_GOLONGAN']?><input name="golArr[<?php echo $trID?>][golongan]" type="hidden" value="<?php echo $res['ID_GOLONGAN']?>"></td>
	<td align="center">
		<?php echo $tglMenjabat==''? '' : date('Y-F-d', intval($tglMenjabat));?>
		<input name="golArr[<?php echo $trID?>][tglMenjabat]" type="hidden" value="<?php echo $tglMenjabat?>">
	</td>
	<td align="center">
		<?php echo $tglBerhenti==''? '' : date('Y-F-d', intval($tglBerhenti));?>
		<input name="golArr[<?php echo $trID?>][tglBerhenti]" type="hidden" value="<?php echo $tglBerhenti?>">
	</td>
	<td align="center"><a onClick="$('<?php echo $trID?>').dispose(); _gol_arr_clear('<?php echo $golID?>')">delete</a></td>
</tr>