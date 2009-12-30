<form name="frmModal" method="post" action="proc/deskripsiBobot.php"><input
	type="hidden" value="debot-update" name="proc" />
<h2 class="dialog_title"><span>Edit Deskripsi Bobot </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $kripen = mysql_fetch_assoc(kripen_load($kripenID)); ?>
<?php $result = debot_load(intval($nilai), $dekripenID); ?>
<?=$result?>
<?php $row = mysql_fetch_assoc($result);?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	  <td width="35%" align="right" valign="middle">Sub Kriteria </td>
	  	<td><?=$row['NAMA_DETAIL_KRITERIA']?><input name="dekripenID" type="hidden" value="<?=$row['ID_DETAIL_KRITERIA']?>"></td>
	  </tr>
	<tr>
      <td align="right" valign="middle">Bobot : </td>
	  <td><span id="nilai"><?=$row['NILAI']?></span><span>%</span>
	  	<input name="nilai" type="hidden" value="<?=$row['NILAI']?>" />
	  </td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc" cols="30" rows="5"><?=$row['DESKRIPSI']?></textarea></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="debot_save(document.frmModal); FBModal_hide()" />
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
