<form name="frmModal" method="post" action="proc/statusKaryawan.php"><input
	type="hidden" value="stskary-update" name="proc" />
<h2 class="dialog_title"><span>Add Status </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $result = stskary_load($stsID); ?>
<?php $row = mysql_fetch_assoc($result); ?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Status :</td>
		<td>
			<input type="text" name="stsID-fake" value="<?=$row['ID_STATUS_KARYAWAN']?>" disabled="disabled" />
			<input name="stsID" type="hidden" value="<?=$row['ID_STATUS_KARYAWAN']?>" />
		</td>
	</tr>
	<tr>
		<td align="right">Nama   :</td>
		<td><input type="text" name="nama" value="<?=$row['NAMA_STATUS']?>" /></td>
	</tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onclick="stskary_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>