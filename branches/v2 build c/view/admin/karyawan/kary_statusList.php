<form name="frmModal" method="post" action="proc/karyawan.php">
<input	type="hidden" value="stskary-save" name="proc" />
<h2 class="dialog_title"><span>History Status Karyawan </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC; padding:10px">
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list">
	<tr class="header">
		<th align="center"><h3><span class="colorWhite">Status</span></h3></th>
		<th align="center"><h3><span class="colorWhite">Tanggal Update</span></h3></th>
		<th width="50" align="center">&nbsp;</th>
	</tr>
	<tbody id="stskary-table" style="overflow:scroll; height:200px;">
	<?php include 'kary_statusListTable.php'?>
	</tbody>
</table>
</div>
<div class="dialog_buttons">
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
