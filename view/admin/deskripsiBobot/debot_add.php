<form name="frmModal" method="post" action="proc/deskripsiBobot.php"><input
	type="hidden" value="debot-save" name="proc" />
<h2 class="dialog_title"><span>Add Deskripsi Bobot </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="35%" align="right" valign="middle"> Kriteria :</td>
		<td>
			<select name="kripenID" onchange="
				doRequest('proc/deskripsiBobot.php', 'post', 'proc=debot-dekripenCombo&kripenID='+this.value, function (res){ $('dekripenID-add').set('html', res);});">
				<?php $kripen = kripen_select(); ?>
				<?php while ($row = mysql_fetch_assoc($kripen)): ?>
					<option value="<?=$row['ID_KRITERIA']?>" <?=$row['ID_KRITERIA']===$kripenID? "selected=\"selected\"" : ""?>>
						<?=$row['NAMA_KRITERIA']?>
					</option>
				<?php endwhile; ?>
			</select>	</td>
	</tr>
	<tr>
	  <td align="right" valign="middle">Sub Kriteria </td>
	  	<td>
	  		<select id="dekripenID-add" name="dekripenID">
			<?php $dekripen = dekripen_select($kripenID); ?>
			<?php while ($row = mysql_fetch_assoc($dekripen)): ?>
				<option value="<?=$row['ID_DETAIL_KRITERIA']?>" 
				<?=$row['ID_DETAIL_KRITERIA']===$dekripenID? "selected=\"selected\"" : ""?>>
			  		<?=$row['NAMA_DETAIL_KRITERIA']?>
			 	</option>
			<?php endwhile; ?>
		  </select>		</td>
	  </tr>
	<tr>
      <td align="right" valign="middle">Bobot : </td>
	  <td><div id="nilaiSpinner"></div>
	      <span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
	  </tr>
	<tr>
	  <td align="right" valign="top">Deskripsi : </td>
	  <td><textarea name="desc" cols="30" rows="5"></textarea></td>
	  </tr>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="debot_save(document.frmModal); FBModal_hide()" />
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
</form>
