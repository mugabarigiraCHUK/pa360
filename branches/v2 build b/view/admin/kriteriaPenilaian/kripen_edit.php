<form name="frmModal" method="post" action="proc/kriteriaPenilaian.php">
<input type="hidden" value="kripen-update" name="proc" />
<input name="kripenID" type="hidden" value="<?= $row['ID_KRITERIA'] ?>" />
<h2 class="dialog_title"><span>Edit Kriteria Penilaian </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $result = kripen_load($kripenID); ?>
<?php $row = mysql_fetch_assoc($result); ?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<!--<tr>
		<td align="right" width="35%">ID Kriteria :</td>
		<td><input type="text" name="kripenID-fake" value="<?= $row['ID_KRITERIA'] ?>"  disabled="disabled"></td>
	</tr>-->
	<tr>
		<td align="right">Nama   :</td>
		<td><input type="text" name="nama" value="<?=$row['NAMA_KRITERIA']?>" /></td>
	</tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc"><?=$row['DESKRIPSI']?></textarea></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="kripen_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>