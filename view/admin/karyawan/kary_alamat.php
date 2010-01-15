<form name="formAlamat">
<h2 class="dialog_title"><span>Add Alamat</span></h2>
<div class="dialog_content" style="padding: 10px 20px">
<table width="357" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="130" valign="top"><div align="right">Alamat :</div></td>
		<td width="207"><textarea name="alamat" cols="30" rows="5"></textarea></td>
	</tr>
	<tr>
		<td>
		<div align="right">Kode Pos :</div>
		</td>
		<td><label> <input type="text" name="kodePos" onkeypress='keypress(event)'> </label></td>
	</tr>
	<tr>
		<td>
		<div align="right">Kode Area :</div>
		</td>
		<td><input type="text" name="kodeArea"></td>
	</tr>
	<tr>
		<td>
		<div align="right">Kota :</div>
		</td>
		<td><input type="text" name="kota"></td>
	</tr>
	<tr>
		<td>
		<div align="right">Propinsi :</div>
		</td>
		<td><input type="text" name="propinsi"></td>
	</tr>
</table>
</div>
<div class="dialog_buttons">
		<input type="button" name="save" value="Save" onclick="alamat_save()">
		<input type="button" name="back" value="Close" onclick="FBModal_hide()">
	</div>
</form>