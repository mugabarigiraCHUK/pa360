<form name="frmModal" method="post" action="proc/karyawan.php">
<input	type="hidden" value="gol-list" name="proc" />
<input	type="hidden" value="<?=$_POST['trID']?>" name="trID" />
<h2 class="dialog_title"><span>Add Jabatan </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC"><?=$res = golongan_select_exclude($exclude);?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	  <td width="35%" align="right">Golongan : </td>
	  <td>
		<select name="golID">
			<?php $exclude = explode(",", $_POST['exclude']); ?>
			<?php $res = golongan_select_exclude($exclude); ?>
			<?php while ($row = mysql_fetch_assoc($res)): ?>
			<option value="<?=$row['ID_GOLONGAN']?>"><?=$row['NAMA_GOLONGAN']?></option>
			<?php endwhile;?>
		</select>	  </td>
	  </tr>
	<tr>
		<td align="right">Tanggal menjabat :</td>
		<td><input class="dtpick" name="tglMenjabat" dtPickerFixedPosition="true" /></td>
	</tr>
	<tr>
	  <td align="right">Tanggal berhenti :</td>
	  <td><input class="dtpick" name="tglBerhenti" dtPickerFixedPosition="true" /></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="this.disabled=true; gol_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
