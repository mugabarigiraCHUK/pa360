<tr id="<?=$trID?>" bgcolor="white">
		<td width="297" align="left">
			<?=$alamat?>
			<input name="alamatArr[<?=$trID?>][alamat]" type="hidden" value="<?=$alamat?>" />
		</td>
		<td width="100" align="center">
			<?=$kodePos?>
			<input name="alamatArr[<?=$trID?>][kodePos]" type="hidden" value="<?=$kodePos?>" />
		</td>
		<td width="100" align="center">
			<?=$kodeArea?>
			<input name="alamatArr[<?=$trID?>][kodeArea]" type="hidden" value="<?=$kodeArea?>" />
		</td>
		<td width="100" align="center">
			<?=$kota?>
			<input name="alamatArr[<?=$trID?>][kota]" type="hidden" value="<?=$kota?>" />
		</td>
		<td width="100" align="center">
			<?=$propinsi?>
			<input name="alamatArr[<?=$trID?>][propinsi]" type="hidden" value="<?=$propinsi?>" />
		</td>
		<td width="52" align="center"><a onclick="alamat_delete('<?=$trID?>')">delete</a></td>
	</tr>