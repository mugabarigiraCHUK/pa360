<div>
	<span>Periode : 
		<select id="periodeID" class="marginL5" onChange="debotlv_updateComboBobotLevel(this.value);">
		<?php $pp = periode_select()?>
		<?php while ($row = mysql_fetch_assoc($pp)): ?>
		<?php if ($z++ == 0) $periodeID = $row['ID_PERIODE']; ?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endwhile;?>
		</select>
	</span>
	<span class="marginL5">Kriteria : 
		<select id="levelID" class="marginL5" onChange="debotlv_updateList()">
			<?php $pp = bobotlv_select($periodeID)?>
			<?php while ($row = mysql_fetch_assoc($pp)): ?>
				<option value="<?=$row['ID_LEVEL']?>"><?=$row['NAMA_LEVEL']?></option>
			<?php endwhile;?>
		</select>
	</span>
</div>
<table class="list marginT5" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="100px" align="center"><h3><span class="colorWhite">ID Kriteria </span></h3></th>
    <th width="150px" align="left"><h3><span class="colorWhite">Nama Kriteria </span></h3></th>
    <th width="100px" align="center"><h3><span class="colorWhite">Bobot (%)</span></h3></th>
    <th align="left"><h3><span class="colorWhite">Deskripsi</span></h3></th>
    <th width="100px" align="right">&nbsp;</th>
  </tr>
  <tbody id="debotlv-table"></tbody>
</table>
<div align="right" class="padT5" style="width:100%"><a class="fake marginR5" onClick="debotlv_add()">Add</a></div>
