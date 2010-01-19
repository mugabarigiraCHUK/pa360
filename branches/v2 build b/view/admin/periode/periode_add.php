<form name="frmModal" method="post" action="proc/periode.php">
<input type="hidden" value="periode-save" name="proc" /> 
<h2 class="dialog_title"><span>Add Periode</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Periode :</td>
		<td><input type="text" name="periodeID"></td>
	</tr>
	<tr>
		<td align="right">Periode awal : </td>
		<td><input id="periodeAwal" class="dtpick" name="periodeAwal" /></td>
	</tr>
	<tr>
		<td align="right">Periode akhir :</td>
		<td><input id="periodeAkhir" class="dtpick" name="periodeAkhir" /></td>
	</tr>
	<tr>
      <td align="right">Batas penilaian awal :</td>
	  <td><input id="batasAwal" class="dtpick" name="batasAwal" /></td>
	  </tr>
	<tr>
      <td align="right">Batas pernilaian akhir :</td>
	  <td><input id="batasAkhir" class="dtpick" name="batasAkhir" /></td>
	  </tr>
	<tr>
		<td align="right">Bobot vertikal :</td>
		<td><div id="bobotV"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
	</tr>
	<tr>
		<td align="right">Bobot horizontal :</td>
		<td><div id="bobotH"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
	</tr>
	<tr>
		<td align="right">Level vertikal :</td>
		<td><div id="lvV"></div></td>
	</tr>
	<tr>
		<td align="right">Level horizontal :</td>
		<td><div id="lvH"></div></td>
	</tr>
</table>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;periode_save(document.frmModal); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
