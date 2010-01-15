<form name="frmModal" action="proc/jabatan.php"> 
<input type="hidden" name="proc" value="jabatan-save" />
<h2 class="dialog_title"><span>Add Jabatan</span></h2>
  <div class="dialog_content">
	  <table width="406" border="0" cellpadding="0" cellspacing="5">
		<tr>
		  <td width="125" align="right">ID Jabatan : </td>
		  <td width="265" colspan="2"><input type="text" name="jbt_id"></td>
		</tr>
		<tr>
		  <td align="right">Nama Jabatan : </td>
		  <td colspan="2"><input type="text" name="nama" style="width:100%"></td>
		</tr>
		<tr>
		  <td align="right">Level Jabatan : </td>
		  <td width="30"><div class="spinner" minVal="1" currentVal="1" name="level[0]"></div></td>
		  <td><div class="spinner" minVal="1" currentVal="1" name="level[1]"></div></td>
		</tr>
	  </table>
  </div>
	<div class="dialog_buttons">
		<input type="button" name="Submit" value="Save" onclick="jabatan_save(document.frmModal)">
		<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
	</div>
</form>
