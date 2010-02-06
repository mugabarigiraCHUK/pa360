<form name="frmModal" method="post" action="proc/client/dataUser.php">
<input type="hidden" value="change-password-save" name="proc" />
<input type="hidden" value="<?=$karyID?>" name="karyID" />
<h2 class="dialog_title"><span>Change Password </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="35%" align="right">Password Lama   :</td>
		<td><input type="password" name="opass"></td>
	</tr>
	<tr>
		<td width="35%" align="right">Password  Baru :</td>
		<td><input type="password" name="npass"></td>
	</tr>
	<tr>
	  <td align="right">Ulang Password Baru: </td>
	  <td><input type="password" name="npass2"></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons">
<input type="button" value="Save" name="save" onClick="savePassword($(this).getParent('form')); FBModal_hide()" />
<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>