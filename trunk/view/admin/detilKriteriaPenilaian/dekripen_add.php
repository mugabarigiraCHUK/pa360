<form name="frmModal" method="post" action="proc/detilKriteriaPenilaian.php"><input
	type="hidden" value="dekripen-save" name="proc" />
<h2 class="dialog_title"><span>Add Detil Kriteria Penilaian </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="35%" align="right" valign="middle">Nama Kriteria :</td>
		<td>
			<select name="kripenID">
			<?php $kripen = kripen_select(); ?>
			<?php while ($row = mysql_fetch_assoc($kripen)): ?>
				<?php if ($z<=0) {$z++; $kripenNama =  $row['NAMA_KRITERIA']; }?>
				<option value="<?=$row['ID_KRITERIA']?>" 
					<?=$row['ID_KRITERIA']===$kripenID? "selected=\"selected\"" : ""?>
					><?=$row['NAMA_KRITERIA']?></option>
			<?php endwhile; ?>
			</select>
		</td>
	</tr>
	<tr>
	  <td align="right" valign="middle">ID Det. Kriteria : </td>
	  <td><input type="text" name="dekripenID">
	    <!--<input class="marginL5" type="button" name="Submit" value="Search" onClick="dekripen_search()">--></td>
	  </tr>
	<tr>
	  <td align="right" valign="middle">Nama Det. Kriteria : </td>
	  <td><input type="text" name="nama"></td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc" cols="30" rows="5"></textarea></td>
	  </tr>
	<tr>
	  <td align="right" valign="middle">Bobot : </td>
	  <td><div id="bobotSpinner"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="this.disabled=true;dekripen_save(document.frmModal); FBModal_hide()" />
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
