<form name="frmSearch" method="post" action="proc/admin/laporan_global.php">
	<input name="proc" type="hidden" value="search-table">
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
	  <td width="100">Periode : </td>
	  <td>
		<?php $selectedPeriodeID = ''; ?>
		<select name="periodeID" onChange="search_updateTable($(this).getParent('form'));">
		<?php $rsPeriode = periode_select(); ?>
		<?php while ($row = mysql_fetch_assoc($rsPeriode)): ?>
		<?php 		$selectedPeriodeID = $selectedPeriodeID===''? $row['ID_PERIODE'] : $selectedPeriodeID; ?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endwhile; ?>
		</select>
	  </td>
	</tr>
	<tr>
	  <td>Departemen : </td>
	  <td>
		<select name="departemenID" onChange="search_updateTable($(this).getParent('form')); dep_updateLabel(this);">
			<option value="false">---- Semua ----</option>
		<?php $selectedDepID = ''; $selectedDepNama=''; ?>
		<?php $rsDep = departemen_select(); ?>
		<?php while ($row = mysql_fetch_assoc($rsDep)): ?>
		<?php 		if ($selectedDepID===''):?>
		<?php 			$selectedDepID = $row['ID_DEPARTMENT']; ?>
		<?php			$selectedDepNama= $row['NAMA_DEPARTMENT']; ?>
		<?php 		endif; ?>
			<option value="<?=$row['ID_DEPARTMENT']?>"><?=$row['NAMA_DEPARTMENT']?></option>
		<?php endwhile; ?>
		</select>
	  </td>
	</tr>
	</table>
</form>
<div id="search-table" class="list marginT5" style="overflow:scroll; min-height:200px; max-height:400px; border:1px solid #457A3F"></div>
<div align="right" class="padT5">Nilai rata - rata Periode : 
	<input type="text" class="fake" value="<?=nilaiAkhir_avg($selectedPeriodeID)?>"  style="width:100px; text-align:right;" disabled="disabled"/>
</div>
<div id="depAvgLabelContainer" align="right" class="padT5" style="display:none">Nilai rata - rata Departemen (<span id="depAvgCaption"><?=$selectedDepNama?></span>) : 
	<input id="depAvgLabel" type="text" class="fake" value="" style="width:100px; text-align:right;" disabled="disabled"/>
</div>
<div class="padT5" align="right"><input type="button" value="Printable version" onclick="show_printPage(document.frmSearch)" /></div>