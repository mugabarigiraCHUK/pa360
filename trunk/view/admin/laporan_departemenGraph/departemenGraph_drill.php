<form name="frmModal" method="post" action="proc/admin/laporan_departemenGraph.php">
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
		<td width="18%" align="left">Departemen :</td>
		<td><select name="departemenID" onchange="drill_table($(this).getParent('form'))">
				<?php foreach($departemenID as $dd):?>	
				<?php 	$DEP = mysql_fetch_array(departemen_load($dd)); ?>
				<option value="<?php echo $dd?>"><?php echo $DEP['NAMA_DEPARTMENT']?></option>
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
		<th align="right"><h3><span class="colorWhite">Nilai Akhir</span></h3></th>
		<th width="10px"></th>
	</tr>
<tbody id="drill-table" style="overflow: hidden; overflow-y:scroll; overflow-x:hidden; height: 250px;"></tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Close" name="close" onclick="FBModal_hide()" /></div>
</div>
</form>