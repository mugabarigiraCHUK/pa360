<form name="frmModal" method="post" action="proc/periode.php">
<input type="hidden" value="periode-edit" name="proc" /> 
<h2 class="dialog_title"><span>Edit Periode</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $id = $_POST['periodeID']; ?>
<?php $rest = periode_load($id);?>
<?php $row = mysql_fetch_assoc($rest);?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td align="right" width="35%">ID Periode :</td>
		<td>
			<input type="text" name="periodeID-fake" value="<?=$row['ID_PERIODE']?>" disabled="disabled">
			<input type="hidden" name="periodeID" value="<?=$row['ID_PERIODE']?>">		</td>
	</tr>
	<tr>
		<td align="right">Periode awal :</td>
		<td><input class="dtpick" name="periodeAwal" value="<?=strtotime($row['PERIODE_AWAL'])?>" /></td>
	</tr>
	<tr>
		<td align="right">Periode akhir :</td>
		<td><input class="dtpick" name="periodeAkhir" value="<?=strtotime($row['PERIODE_AKHIR'])?>" /></td>
	</tr>
	<tr>
      <td align="right">Batas penilaian awal :</td>
	  <td><input class="dtpick" name="batasAwal" value="<?=strtotime($row['BATAS_AWAL_PENILAIAN'])?>" /></td>
	  </tr>
	<tr>
      <td align="right">Batas pernilaian akhir :</td>
	  <?php $dd = explode("-",$row['BATAS_AKHIR_PENILAIAN '])?>
      <td><input class="dtpick" name="batasAkhir" value="<?=strtotime($row['BATAS_AKHIR_PENILAIAN'])?>" /></td>
	  </tr>
	
	<tr>
		<td align="right">Bobot vertikal :</td>
		<td><div id="bobotV" spinnerValue="<?= $row['BOBOT_VERTIKAL']?>"></div>
			<span style="position:fixed; margin-left:46px; margin-top:-15px">%</span></td>
	</tr>
	<tr>
		<td align="right">Bobot horizontal :</td>
		<td><div id="bobotH" spinnerValue="<?= $row['BOBOT_HORIZONTAL']?>"></div>
			<span style="position:fixed; margin-left:46px; margin-top:-15px">%</span></td>
	</tr>
	<tr>
		<td align="right">Level vertikal :</td>
		<td><div id="lvV" spinnerValue="<?=$row['LEVEL_VERTIKAL']?>"></div></td>
	</tr>
	<tr>
		<td align="right">Level horizontal :</td>
		<td><div id="lvH" spinnerValue="<?=$row['LEVEL_HORIZONTAL']?>"></div></td>
	</tr>
</table>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;periode_save(document.frmModal); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
