<tr id="<?=$trID?>" bgcolor="#FFFFFF">
	<input name="jobArr[<?=$trID?>][dep_div_jabID]" type="hidden" value="<?=$dep_div_jabID?>">
	<?php $res = mysql_fetch_assoc(departemen_load($depID)); ?>
	<td align="center">
		<?=$res['NAMA_DEPARTMENT']?>
		<input name="jobArr[<?=$trID?>][departemen]" type="hidden" value="<?=$res['ID_DEPARTMENT']?>">
	</td>
	<?php $res = mysql_fetch_assoc(divisi_load($divID)); ?>
	<td align="center">
		<?=$res['NAMA_DIVISI']?>
		<input name="jobArr[<?=$trID?>][divisi]" type="hidden" value="<?=$res['ID_DIVISI']?>">
	</td>
	<?php $res = mysql_fetch_assoc(jbt_load($jabID)); ?>
	<td align="center">
		<?=$res['NAMA_JABATAN']?>
		<input name="jobArr[<?=$trID?>][jabatan]" type="hidden" value="<?=$res['ID_JABATAN']?>">
	</td>
	<td align="center">
		<?=$tglMenjabat==''? '' : date('Y-F-d', intval($tglMenjabat) )?>
		<input name="jobArr[<?=$trID?>][tglMenjabat]" type="hidden" value="<?=$tglMenjabat?>">
	</td>
	<td align="center">
		<?=$tglBerhenti==''? '' : date('Y-F-d', intval($tglBerhenti) )?>
		<input name="jobArr[<?=$trID?>][tglBerhenti]" type="hidden" value="<?=$tglBerhenti?>">
	</td>
	<td align="center"><a onclick="job_delete('<?=$trID?>', '<?=$dep_div_jabID?>')">delete</a></td>
</tr>