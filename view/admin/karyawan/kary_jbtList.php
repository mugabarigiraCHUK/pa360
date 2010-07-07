<h2 class="dialog_title"><span>History Jabatan</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC; padding:10px">
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list">
	<tr class="header">
		<th align="left"><h3><span class="colorWhite">Jabatan</span></h3></th>
		<th align="left"><h3><span class="colorWhite">Departemen</span></h3></th>
		<th align="left"><h3><span class="colorWhite">Divisi</span></h3></th>
		<th align="right"><h3><span class="colorWhite">Tanggal Menjabat</span></h3></th>
		<th align="right"><h3><span class="colorWhite">Tanggal Berhenti</span></h3></th>
		<th width="10" align="center">&nbsp;</th>
	</tr>
	<tbody id="stskary-table" style="overflow:scroll; overflow-x:hidden; height:200px;">
	<?php $res = RELASIJABATAN_load($karyID)?>
	<?php while ($row= mysql_fetch_assoc($res)) : ?>
	<tr>
		<td align="left"><?php echo $row['NAMA_JABATAN']?></td>
		<td align="left"><?php echo $row['NAMA_DEPARTMENT']?></td>
		<td align="left"><?php echo $row['NAMA_DIVISI']?></td>
		<td align="right"><?php echo date_normalize($row['TANGGAL_MENJABAT'], 'd M Y')?></td>
		<td align="right"><?php echo date_normalize($row['TANGGAL_BERHENTI'], 'd M Y')?></td>
		<td align="left"></td>
	</tr>
	<?php endwhile;?>
	</tbody>
</table>
</div>
<div class="dialog_buttons">
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>
