<form name="frmModal" method="post" action="proc/karyawan.php">
<input	type="hidden" value="job-list" name="proc" />
<input	type="hidden" value="<?php echo $_POST['trID']?>" name="trID" />
<h2 class="dialog_title"><span>Add Jabatan </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">Departemen : </td>
		<td>
			<select name="depID">
			<?php $res = departemen_select(); ?>
			<?php while ($row = mysql_fetch_assoc($res)): ?>
				<option value="<?php echo $row['ID_DEPARTMENT']?>"><?php echo $row['NAMA_DEPARTMENT']?></option>
			<?php endwhile;?>
			</select>		</td>
	</tr>
	<tr>
		<td align="right">Divisi : </td>
		<td>
			<select name="divID">
			<?php $res = divisi_select(); ?>
			<?php while ($row = mysql_fetch_assoc($res)): ?>
				<option value="<?php echo $row['ID_DIVISI']?>"><?php echo $row['NAMA_DIVISI']?></option>
			<?php endwhile;?>
			</select>		</td>
	</tr>
	<tr>
	  <td align="right">Jabatan : </td>
	  <td>
		<select name="jabID">
			<?php $res = jbt_select(); ?>
			<?php while ($row = mysql_fetch_assoc($res)): ?>
			<option value="<?php echo $row['ID_JABATAN']?>"><?php echo $row['NAMA_JABATAN']?></option>
			<?php endwhile;?>
		</select>	  </td>
	  </tr>
	<tr>
		<td align="right">Tanggal menjabat  :</td>
		<td><input class="dtpick" name="tglMenjabat" dtPickerFixedPosition="true"/></td>
	</tr>
	<tr>
	  <td align="right">Tanggal berhenti : </td>
	  <td><input class="dtpick" name="tglBerhenti" dtPickerFixedPosition="true" /></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="this.disabled=true; job_save(document.frmModal); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
<script>$('depNama').set('html', $(document.frmModal.depID.options[this.selectedIndex]).get('value2'));</script>
