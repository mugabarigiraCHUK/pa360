<form name="frmModal" method="post" action="proc/divisi.php"><input
	type="hidden" value="divisi-update" name="proc" />
<h2 class="dialog_title"><span>Add Divisi</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $result = divisi_load($divID)?>
<?php $result = mysql_fetch_assoc($result)?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Divisi :</td>
		<td><input type="text" name="divID-fake" value="<?=$result['ID_DIVISI']?>" disabled="disabled"> <input type="hidden"
			name="divID" value="<?=$result['ID_DIVISI']?>" /></td>
	</tr>
	<tr>
		<td align="right">Nama Divisi :</td>
		<td><input type="text" name="divNama" value="<?=$result['NAMA_DIVISI']?>"></td>
	</tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onclick="divisi_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
<script></script>
