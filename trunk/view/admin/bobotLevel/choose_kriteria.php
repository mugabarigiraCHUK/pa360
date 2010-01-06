<form name="frmModal" action="proc/bobotLevel.php" method="post">
<input type="hidden" value="kriteria-add" name="proc" /> 
<h2 class="dialog_title"><span>Setting Kriteria Penilaian</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
	<div style="padding:10px"><?= $result?>
		<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list marginT5">
			<tr class="header">
				<td width="100" align="center"><h3><span class="colorWhite">ID Kriteria</span></h3></td>
			    <td align="center"><h3><span class="colorWhite">Nama Kriteria</span></h3></td>
			    <td width="100" align="center"><h3><span class="colorWhite">Bobot (%)</span></h3></td>
			</tr>
			<!--<tbody style="overflow:scroll; height:200px;">-->
			<?php $result = debotlv_select($periodeID, $levelID); ?>
			<?php while ($row = mysql_fetch_assoc($result)): ?>
				<tr <?=tag_zebra($z++)?>>
					<td width="100" align="center"><?=$row['ID_KRITERIA']?></td>
					<td align="center"><?=$row['NAMA_KRITERIA']?></td>
					<td width="100" align="center"><?=$row['BOBOT']?></td>
				</tr>
			<?php endwhile; ?>
			<!--</tbody>-->
			<tr class="header">
				<td width="100" align="center" colspan="2"><h3><span class="colorWhite">Total Bobot</span></h3></td>
				<td width="100" align="center"><h3><span id="kriteria-table-count" class="colorWhite">20(%)</span></h3></td>
			</tr>
		</table>
		<div align="right" class="marginR5"><a>Add</a></div>
	</div>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;bobotLevel_save(document.frmModal); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
