<form name="frmModal" method="post" action="proc/detilKriteriaPenilaian.php"><input
	type="hidden" value="dekripen-update" name="proc" />
<h2 class="dialog_title"><span>Edit Detil Kriteria Penilaian </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<?php $result = dekripen_load($dekripenID); ?>
<?php $result = mysql_fetch_assoc($result); ?>
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="35%" align="right" valign="middle">Nama Kriteria :</td>
		<td><?=$result['NAMA_KRITERIA']?><input name="kripenID" type="hidden" value="<?=$result['ID_KRITERIA']?>" />
			<!--<select name="kripenID">
			<?php $kripen = kripen_select(); ?>
			<?php while ($row = mysql_fetch_assoc($kripen)): ?>
				<?php if ($z<=0) {$z++; $kripenNama =  $result['NAMA_KRITERIA']; }?>
				<option value="<?=$row['ID_KRITERIA']?>" 
					<?=$row['ID_KRITERIA']===$result['ID_KRITERIA']? "selected=\"selected\"" : ""?>>
					<?=$row['NAMA_KRITERIA']?>
				</option>
			<?php endwhile; ?>
			</select>-->
		</td>
	</tr>
	<tr>
	  <td align="right" valign="middle">ID Det. Kriteria : </td>
	  <td><input type="text" name="dekripenID-fake" value="<?=$result['ID_DETAIL_KRITERIA']?>" disabled="disabled">
	  	<input name="dekripenID" type="hidden" value="<?=$result['ID_DETAIL_KRITERIA']?>">
	    <!--<input class="marginL5" type="button" name="Submit" value="Search" onClick="dekripen_search()">--></td>
	  </tr>
	<tr>
	  <td align="right" valign="middle">Nama Det. Kriteria : </td>
	  <td><input type="text" name="nama" value="<?=$result['NAMA_DETAIL_KRITERIA']?>"></td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc" cols="30" rows="5"><?=$result['DESKRIPSI']?></textarea></td>
	  </tr>
	<tr>
	  <td align="right" valign="middle">Bobot : </td>
	  <td><div id="bobotSpinner" initVal="<?=$result['BOBOT']?>"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="this.disabled=true;dekripen_save(document.frmModal); FBModal_hide()" />
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
