<?php $result = debotlv_loadByID($debotlvID)?>
<?php $row = mysql_fetch_assoc($result); ?>
<form name="frmModal" action="proc/detilBobotLevel.php" method="post">
<input name="proc"  type="hidden" value="debotlv-update" /> 
<input name="debotlvID" type="hidden" value="<?=$debotlvID?>" />
<input name="kripenID" type="hidden" value="<?=$row['ID_KRITERIA']?>" />
<input name="bobotlvID" type="hidden" value="<?=$row['ID_BOBOT_LEVEL']?>" />
<h2 class="dialog_title"><span>Prosentase Bobot Kriteria</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
	<div style="padding:10px">
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
			<tbody>
			<tr>
				<td width="100" align="right">Periode : </td>
			    <td><input value="<?=$row['ID_PERIODE']?>" class="fake" disabled="disabled" /></td>
			</tr>
			<tr>
			  <td align="right">Level : </td>
			  <td><input value="<?=$row['NAMA_LEVEL']?>" class="fake" disabled="disabled" /></td>
			</tr>
			<tr>
			  <td align="right">Kriteria : </td>
			  <td><input value="<?=$row['NAMA_KRITERIA']?>" class="fake" disabled="disabled" /></td>
			  </tr>
			<tr>
			  <td align="right">Bobot : </td>
			  <td><div id="bobot" spinnerValue="<?=$row['BOBOT']?>"></div><span style="position:absolute; margin-left:46px; margin-top:-15px">%</span></td>
			  </tr>
			</tbody>
		</table>
	</div>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;debotlv_updateKriteria($(this).getParent('form')); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
