<div>Search : <input type="text" class="marginL5" style="width:200px;" onkeyup="debot_updateList(this.value)" /></div>
<div class="padT5">
	<div style="position:relative; display:inline; padding-right:5px;"><strong>Kriteria : </strong></div>
		<select id="kripenID" onchange="debot_updateDekripen()"
		 style="margin-right:20px;">
		<?php $kripen = kripen_select(); ?>
		<?php while ($row = mysql_fetch_assoc($kripen)): ?>
			<?php if ($z<=0) {$z++; $kripenID = $row['ID_KRITERIA']; }?>
			<option value="<?=$row['ID_KRITERIA']?>"><?=$row['NAMA_KRITERIA']?></option>
		<?php endwhile; ?>
	</select>
	<div style="position:relative; display:inline; padding-right:5px;"><strong>Sub Kriteria : </strong></div>
		<select id="dekripenID" onchange="debot_updateList()">
		<?php $dekripen = dekripen_select($kripenID); ?>
		<?php while ($row = mysql_fetch_assoc($dekripen)): ?>
			<option value="<?=$row['ID_DETAIL_KRITERIA']?>"><?=$row['NAMA_DETAIL_KRITERIA']?></option>
		<?php endwhile; ?>
	</select>
</div>

<table class="list marginT5" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="100px" align="center"><h3><span class="colorWhite">Kriteria</span></h3></th>
    <th width="150px" align="center"><h3><span class="colorWhite">Nilai</span></h3></th>
    <th align="center"><h3><span class="colorWhite">Deskripsi</span></h3></th>
    <th width="100px" align="right">&nbsp;</th>
  </tr>
  <tbody id="debot-table"></tbody>
</table>
<div align="right" class="padT5" style="width:100%"><a class="fake marginR5" onClick="debot_add()">Add</a></div>
