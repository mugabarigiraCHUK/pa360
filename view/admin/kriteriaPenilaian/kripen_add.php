<form name="frmModal" method="post" action="proc/kriteriaPenilaian.php"><input
	type="hidden" value="kripen-save" name="proc" />
<h2 class="dialog_title"><span>Add Kriteria Penilaian </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<!--<tr>
		<td align="right" width="35%">ID Kriteria :</td>
		<td><input type="text" name="kripenID"></td>
	</tr>-->
	<tr>
		<td align="right">Nama   :</td>
		<td><input type="text" name="nama" /></td>
	</tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc"></textarea></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="kripen_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
