<form name="frmModal" method="post" action="proc/departemen.php"><input
	type="hidden" value="departemen-save" name="proc" />
<h2 class="dialog_title"><span>Add Departemen</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Departemen :</td>
		<td><input type="text" name="dep_id"></td>
	</tr>
	
	<tr>
		<td align="right">Nama Departemen :</td>
		<td><input type="text" name="depNama"></td>
	</tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onclick="departemen_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
<script>$('depNama').set('html', $(document.frmModal.depID.options[this.selectedIndex]).get('value2'));</script>
