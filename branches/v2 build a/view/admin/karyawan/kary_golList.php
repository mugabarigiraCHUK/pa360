<?php 
if ($golID=="") exit();
?>
<?php $res = mysql_fetch_assoc(golongan_load($golID)); ?>
<tr id="<?=$trID?>" bgcolor="#FFFFFF">
	<td align="center"><?=$res['NAMA_GOLONGAN']?><input name="golArr[<?=$trID?>][golongan]" type="hidden" value="<?=$res['ID_GOLONGAN']?>"></td>
	<td align="center">
		<?=$tglMenjabat==''? '' : date('Y-F-d', intval($tglMenjabat));?>
		<input name="golArr[<?=$trID?>][tglMenjabat]" type="hidden" value="<?=$tglMenjabat?>">
	</td>
	<td align="center">
		<?=$tglBerhenti==''? '' : date('Y-F-d', intval($tglBerhenti));?>
		<input name="golArr[<?=$trID?>][tglBerhenti]" type="hidden" value="<?=$tglBerhenti?>">
	</td>
	<td align="center"><a onClick="$('<?=$trID?>').dispose(); _gol_arr_clear('<?=$golID?>')">delete</a></td>
</tr>