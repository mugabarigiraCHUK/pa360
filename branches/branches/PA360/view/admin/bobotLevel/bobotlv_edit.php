<form name="frmModal" action="proc/bobotLevel.php" method="post">
<input type="hidden" value="bobotLevel-update" name="proc" /> 
<h2 class="dialog_title"><span>Prosentase Penilaian</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
	<div style="padding:10px">
		<?php $result = bobotlv_load($periodeID, $levelID)?>
		<?php $row = mysql_fetch_assoc($result); ?>
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
			<tbody>
			<tr>
				<td width="100" align="right">Periode : </td>
			    <td><?=$periodeID?><input name="periodeID" type="hidden" value="<?=$periodeID?>" /></td>
			</tr>
			<tr>
			  <td align="right">Level : </td>
			  <td><?=$row['NAMA_LEVEL']?><input name="levelID" type="hidden" value="<?=$levelID?>" /></td>
			  </tr>
			<tr>
			  <td align="right">Bobot : </td>
			  <td><div id="bobot" spinnerValue="<?=$row['BOBOT']?>"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
			  </tr>
			<tr>
			  <td align="right" valign="top">Deskripsi : </td>
			  <td><textarea name="desc" cols="30" rows="3"><?=$row['DESKRIPSI']?></textarea></td>
			  </tr>
			</tbody>
		</table>
	</div>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;bobotLevel_save(document.frmModal); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
