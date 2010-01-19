<!-- penilai.php -->
<h2 style="border-bottom: 1px solid #CCC">Karyawan Penilai</h2>
<form id="frmPenilai" name="frmPenilai" action="proc/penilai.php" method="post">
	<input type="hidden" name="proc" value="" />
	<input name="karyID" type="hidden" value="" />
	<table style="width:100%">
		<tr>
			<td width="80" align="left">Karyawan : </td>
			<td colspan="5"><input id="searchKey" name="searchKey" class="fake" type="text" style="width:200;" disabled="disabled" onchange="penilai_updateJabatanCombo($(this).getParent('form'));" />
		  <input type="button" class="marginL5" name="search" value="Search" onclick="penilai_searchKary_modal()" />			</td>
		</tr>
		<tr>
			<td align="left">Jabatan : </td>
		  <td width="237"><select name="dep_div_jabID" onchange="penilai_updateTable($(this).getParent('form'));" style="overflow:hidden"></select></td>
		    <td width="110" align="left">Departemen : </td>
		    <td width="160"><input class="fake" name="departemen" type="text" value="" disabled="disabled" /></td>
		    <td width="70" align="left">Divisi : </td>
		    <td width="273" ><input class="fake" name="divisi" type="text" value="" disabled="disabled" /></td>
		</tr>
		<tr>
		  <td align="left">Periode : </td>
		  <td>
		  	<?php $res = periode_select(); ?>
			<select id="periodeID" name="periodeID" class="" onchange="penilai_updateTable($(this).getParent('form')); penilai_updateLevel($(this).getParent('form'))">
			<?php while ($ll = mysql_fetch_assoc($res)) : ?>
			<?php $periodeID= $periodeID==""? $ll['ID_PERIODE'] : $periodeID?>
				<option value="<?=$ll['ID_PERIODE']?>" <?=$periodeID===$ll['ID_PERIODE']? "selected=\"selected\"" : "" ?> ><?=$ll['ID_PERIODE']?></option>
			<?php endwhile;?>
			</select>
		  </td>
          <td align="left">Status Penilaian :</td>
          <td><select name="stsPenilaian" onchange="penilai_updateTable($(this).getParent('form'))">
            <?php $res = bobotlv_select(false, $periodeID); ?>
			<?php while ($ll = mysql_fetch_assoc($res)) : ?>
				<option value="<?=$ll['ID_LEVEL']?>"><?=$ll['NAMA_LEVEL']?></option>
			<?php endwhile;?>
          </select></td>
          <td align="left"></td>
          <td></td>
	  </tr>
  </table>

<h2 style="border-bottom: 1px solid #CCC" class="padT10">Karyawan Dinilai</h2>
<table style="width:100%">
  <tr>
    <td width="80" align="left">Departemen  : </td>
    <td width="866" colspan="5">
		<select name="departemenID" onchange="penilai_updateTable($(this).getParent('form'))">
			<option value="0">--- Semua Departemen ---</option>
			<?php $depart = departemen_select()?>
			<?php while ($dd = mysql_fetch_assoc($depart)):  ?>
			<?php $departemenID= $departemenID==""? $dd['ID_DEPARTMENT'] : $departemenID?>
			<option value="<?=$dd['ID_DEPARTMENT']?>"><?=$dd['NAMA_DEPARTMENT']?></option>
			<?php endwhile;?>
		</select>
    </td>
  </tr>
</table>
<div id="kriteriaTab" class="padT10" style="position:relative">
	<ul class="tabs_title">
		<li title="kary-dinilai">Karyawan</li>
		<li title="kary-dinilai-konflik">Konflik</li>
	</ul>
	<div id="kary-dinilai" class="tabs_panel">
		<div align="right" style="width:200px; position:absolute; right:0; top:-20px;">
			<a class="fake" onclick="getTabbedpaneState().getElements('.kary-dinilai-table-checkbox').set('checked', true).fireEvent('change')">check all</a> / 
			<a class="fake" onclick="getTabbedpaneState().getElements('.kary-dinilai-table-checkbox').set('checked', false).fireEvent('change')">uncheck all</a>
		</div>
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
		  <tr class="header">
			<th width="20" align="center"><h3>&nbsp;</h3></th>
			<th align="left"><h3><span class="colorWhite">Nama</span></h3></th>
			<th align="left"><h3><span class="colorWhite">Jabatan</span></h3></th>
			<th align="left"><h3><span class="colorWhite">Divisi</span></h3></th>
		    <th align="left"><h3><span class="colorWhite">Departemen</span></h3></th>
			<th align="left" width="10"></th>
		  </tr>
		  <tbody id="kary-dinilai-table" style="overflow:scroll; overflow-x:hidden; max-height:300px;"></tbody>
		</table>
		<div align="right" style="width:200px; position:absolute; right:0; padding-top:2px">
			<a class="fake" onclick="getTabbedpaneState().getElements('.kary-dinilai-table-checkbox').set('checked', true).fireEvent('change')">check all</a> / 
			<a class="fake" onclick="getTabbedpaneState().getElements('.kary-dinilai-table-checkbox').set('checked', false).fireEvent('change')">uncheck all</a>
		</div>
	</div>
	<div id="kary-dinilai-konflik" class="tabs_panel">
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
		  <tr class="header">
			<th align="left"><h3><span class="colorWhite">Nama</span></h3></th>
			<th align="left"><h3><span class="colorWhite">Jabatan</span></h3></th>
			<th align="left"><h3><span class="colorWhite">Divisi</span></h3></th>
		    <th align="left"><h3><span class="colorWhite">Departemen</span></h3></th>
		    <th align="left"><h3><span class="colorWhite">Penilai</span></h3></th>
			<th align="left" width="10"></th>
		  </tr>
		  <tbody id="kary-dinilai-konflik-table" style="overflow:scroll; overflow-x:hidden; max-height:300px;"></tbody>
		</table>
	</div>
</div>
</form> 
<!-- penilai.php End-->
