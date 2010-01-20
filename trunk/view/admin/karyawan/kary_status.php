<form name="frmModal" method="post" action="proc/karyawan.php">
<input	type="hidden" value="stskary-save" name="proc" />
<input	type="hidden" value="<?=$karyID?>" name="karyID" />
<h2 class="dialog_title"><span>Add History  Status Karyawan </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	  <td width="35%" align="right">Tanggal : </td>
	  <td><?=date("Y-F-d",time())?></td>
	  </tr>
	<tr>
		<td align="right">Status : </td>
		<td>
			<?php $res = stskary_select(); ?>
			<select name="stskaryID">
			<?php while ($row = mysql_fetch_assoc($res)):?>
				<option value="<?=$row['ID_STATUS_KARYAWAN']?>"><?=$row['NAMA_STATUS']?></option>
			<?php endwhile;?>
			</select>
		</td>
	</tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="this.disabled=true; kary_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
