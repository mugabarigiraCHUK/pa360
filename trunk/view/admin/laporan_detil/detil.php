<form name="frmSearch">
	<input type="hidden" value="" name="proc" />
	<input type="hidden" value="<?=$karyID?>" name="karyID" />
	<input type="hidden" value="<?=$periodeID?>" name="periodeID" />
	<input type="hidden" value="<?=$departemenID?>" name="departemenID" />
	<input type="hidden" value="<?=dep_div_jabID?>" name="dep_div_jabID2" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="100">Periode : </td>
		<td>
			<select name="periodeID" onChange="search_updateTable($(this).getParent('form'));">
			<?php $rsPeriode = periode_select(); ?>
			<?php while ($row = mysql_fetch_assoc($rsPeriode)): ?>
				<option value="<?=$row['ID_PERIODE']?>" <?=$periodeID===$row['ID_PERIODE']?"selected=\"selected\"":""?>><?=$row['ID_PERIODE']?></option>
			<?php endwhile; ?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Karyawan : </td>
		<?php $KARY = mysql_fetch_assoc(kary_load($karyID));?>
		<td><input name="karyLabel" type="text" class="fake" value="<?=$KARY['NAMA_KARYAWAN']?>" style="width:200px" disabled="disabled" onchange="search_updateTable($(this).getParent('form'));" />
			<input type="button" class="marginL5" name="search" value="Search" onclick="searchKary_modal()" />
		</td>
	</tr>
	<tr>
		<td>Jabatan : </td>
		<td><select name="dep_div_jabID" onchange="search_updateTable($(this).getParent('form'));"></select>
		</td>
	</tr>
	<tr>
		<td>Departemen : </td>
		<td><span id="departemenLabel"></span></td>
	</tr>
	<tr>
		<td>Divisi : </td>
		<td><span id="divisiLabel"></span></td>
	</tr>
</table>
</form>
<div id="search-table"></div>
<div class="padT5">
	<input type="button" class="marginL5" onClick="show_printPage($(document.frmSearch))" value="Printable Version" />
</div>