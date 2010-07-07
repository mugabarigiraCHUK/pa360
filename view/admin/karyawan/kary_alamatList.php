<tr id="<?php echo $trID?>" bgcolor="white">
		<td width="297" align="left">
			<input name="alamatArr[<?php echo $trID?>][alamatID]" type="hidden" value="<?php echo $alamatID?>" />
			<?php echo $alamat?>
			<input name="alamatArr[<?php echo $trID?>][alamat]" type="hidden" value="<?php echo $alamat?>" />
		</td>
		<td width="100" align="center">
			<?php echo $kodePos?>
			<input name="alamatArr[<?php echo $trID?>][kodePos]" type="hidden" value="<?php echo $kodePos?>" />
		</td>
		<td width="100" align="center">
			<?php echo $kodeArea?>
			<input name="alamatArr[<?php echo $trID?>][kodeArea]" type="hidden" value="<?php echo $kodeArea?>" />
		</td>
		<td width="100" align="center">
			<?php echo $kota?>
			<input name="alamatArr[<?php echo $trID?>][kota]" type="hidden" value="<?php echo $kota?>" />
		</td>
		<td width="100" align="center">
			<?php echo $propinsi?>
			<input name="alamatArr[<?php echo $trID?>][propinsi]" type="hidden" value="<?php echo $propinsi?>" />
		</td>
		<td width="52" align="center"><a onclick="alamat_delete('<?php echo $trID?>', '<?php echo $alamatID?>')">delete</a></td>
	</tr>