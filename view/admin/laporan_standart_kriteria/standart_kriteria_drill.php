<form name="frmModal" method="post" action="proc/admin/laporan_standart_kriteria.php">
<input type="hidden" value="" name="proc" />
<h2 class="dialog_title"><span>Data</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="18%" align="left">Periode :</td>
		<td><?php echo $periodeID?> <input type="hidden" name="periodeID" value="<?php echo $periodeID?>" /></td>
	</tr>
	<tr>
		<td width="18%" align="left">Level :</td>
		<td><?php echo $levelID?> <input type="hidden" name="levelID" value="<?php echo $levelID?>" /></td>
	</tr>
	<tr>
		<td width="18%" align="left">Kriteria :</td>
		<td><select name="kripenID" onchange="drill_table($(this).getParent('form'))">
				<?php foreach($kripenArr as $dd):?>	
				<?php 	$KRIPEN = mysql_fetch_array(kripen_load($dd)); ?>
				<?php 	$kripenID = !$kripenID? $KRIPEN['ID_KRITERIA'] : $kripenID ?>
				<option value="<?php echo $KRIPEN['ID_KRITERIA']?>"><?php echo $KRIPEN['NAMA_KRITERIA']?></option>
				<?php endforeach; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td align="left">Nilai :</td>
		<td>
			<select name="constraint" onchange="drill_table($(this).getParent('form'))">
				<option value="1">Di atas rata-rata</option>
				<option value="-1">Di bawah  rata-rata</option>
			</select>
		</td>
	</tr>
</table>
<table width="100%" cellpadding="5" cellspacing="0" class="list">
	<tr class="header">
		<th align="left"><h3><span class="colorWhite">Kode</span></h3></th>
		<th align="left"><h3><span class="colorWhite">Nama Karyawan</span></h3></th>
		<th align="right"><h3><span class="colorWhite">Nilai Kriteria</span></h3></th>
		<th width="10px"></th>
	</tr>
<tbody id="drill-table" style="overflow: hidden; overflow-y:scroll; overflow-x:hidden; height: 250px;"></tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Close" name="close" onclick="FBModal_hide()" /></div>
</div>
</form>