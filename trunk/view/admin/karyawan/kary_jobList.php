<tr id="<?php echo $trID?>" bgcolor="#FFFFFF">
	<?php $res = mysql_fetch_assoc(departemen_load($depID)); ?>
	<td align="center">
		<input name="jobArr[<?php echo $trID?>][dep_div_jabID]" type="hidden" value="<?php echo $dep_div_jabID?>">
		<?php echo $res['NAMA_DEPARTMENT']?>
		<input name="jobArr[<?php echo $trID?>][departemen]" type="hidden" value="<?php echo $res['ID_DEPARTMENT']?>">
	</td>
	<?php $res = mysql_fetch_assoc(divisi_load($divID)); ?>
	<td align="center">
		<?php echo $res['NAMA_DIVISI']?>
		<input name="jobArr[<?php echo $trID?>][divisi]" type="hidden" value="<?php echo $res['ID_DIVISI']?>">
	</td>
	<?php $res = mysql_fetch_assoc(jbt_load($jabID)); ?>
	<td align="center">
		<?php echo $res['NAMA_JABATAN']?>
		<input name="jobArr[<?php echo $trID?>][jabatan]" type="hidden" value="<?php echo $res['ID_JABATAN']?>">
	</td>
	<td align="center">
		<?php echo $tglMenjabat==''? '' : date('Y-F-d', intval($tglMenjabat) )?>
		<input name="jobArr[<?php echo $trID?>][tglMenjabat]" type="hidden" value="<?php echo $tglMenjabat?>">
	</td>
	<td align="center">
		<?php echo $tglBerhenti==''? '' : date('Y-F-d', intval($tglBerhenti) )?>
		<input name="jobArr[<?php echo $trID?>][tglBerhenti]" type="hidden" value="<?php echo $tglBerhenti?>">
	</td>
	<td align="center"><a onclick="job_delete('<?php echo $trID?>', '<?php echo $dep_div_jabID?>')">delete</a></td>
</tr>