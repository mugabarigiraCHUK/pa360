<form name="frmModal" method="post" action="proc/departemen.php"><input
	type="hidden" value="departemen-update" name="proc" />
<h2 class="dialog_title"><span>Edit Departemen</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $result = departemen_load($dep_id)?>
<?php $result = mysql_fetch_assoc($result)?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Departemen :</td>
		<td><input type="text" name="dep_id-fake" value="<?=$result['ID_DEPARTMENT']?>" disabled="disabled"> <input type="hidden"
			name="dep_id" value="<?=$result['ID_DEPARTMENT']?>" /></td>
	</tr>
	<tr>
		<td align="right">Nama Departemen :</td>
		<td><input type="text" name="depNama" value="<?=$result['NAMA_DEPARTMENT']?>"></td>
	</tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onclick="departemen_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
<script></script>
