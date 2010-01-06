<div>Search : <input type="text" class="marginL5" style="width:200px;" onkeyup="dekripen_updateList(this.value)"/></div>
<div class="padT5"><h3 style="width:300px; text-align:right; display:inline; padding-right:5px">Kriteria : </h3>
	<select id="kripenID" name="kripenID" onchange="dekripen_updateList()">
	<?php $kripen = kripen_select(); ?>
	<?php while ($row = mysql_fetch_assoc($kripen)): ?>
		<option value="<?=$row['ID_KRITERIA']?>"><?=$row['NAMA_KRITERIA']?></option>
	<?php endwhile; ?>
	</select>
</div>
<table class="list marginT5" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="100px" align="center"><h3><span class="colorWhite">ID Kriteria </span></h3></th>
    <th width="150px" align="left"><h3><span class="colorWhite">Nama Kriteria </span></h3></th>
    <th width="100px" align="center"><h3><span class="colorWhite">ID Det. Kriteria</span></h3></th>
    <th width="150px" align="left"><h3><span class="colorWhite">Nama Det. Kriteria</span> </h3></th>
    <th width="100px" align="center"><h3><span class="colorWhite">Bobot (%)</span></h3></th>
    <th width="" align="left"><h3><span class="colorWhite">Deskripsi</span></h3></th>
    <th width="100px" align="right">&nbsp;</th>
  </tr>
  <tbody id="dekripen-table"></tbody>
</table>
<div align="right" class="padT5" style="width:100%"><a class="fake marginR5" onClick="dekripen_add()">Add</a></div>
