<!-- penilai.php -->
<h2 style="border-bottom: 1px solid #CCC">Daftar Karyawan</h2>
<form id="frmSearch" name="frmSearch" action="proc/penilai.php" method="post">
	<input type="hidden" name="proc" value="" />
	<input name="karyID" type="hidden" value="" />
	<table style="width:100%">
		<tr>
			<td width="67" align="left">Karyawan : </td>
			<td colspan="5"><input id="searchKey" name="searchKey" class="fake" type="text" style="width:200;" disabled="disabled" onchange="penilai_updateJabatanCombo($('frmSearch'));" />
		  <input type="button" class="marginL5" name="search" value="Search" onclick="penilai_searchKary_modal()" />			</td>
		</tr>
		<tr>
			<td align="left">Jabatan : </td>
			<td width="250"><select name="dep_div_jabID" class="" onchange="penilai_updateTable($('frmSearch'));" style="overflow:hidden"></select></td>
		    <td width="110" align="left">Departemen : </td>
		    <td width="160"><input class="fake" name="departemen" type="text" value="" disabled="disabled" /></td>
		    <td width="70px" align="left">Divisi : </td>
		    <td ><input class="fake" name="divisi" type="text" value="" disabled="disabled" /></td>
		</tr>
		<tr>
		  <td align="left">Periode : </td>
		  <td>
		  	<?php $res = periode_select(); ?>
			<select id="periodeID" name="periodeID" class="" onchange="penilai_updateTable($('frmSearch')); penilai_updateLevel($('frmSearch'))">
			<?php while ($ll = mysql_fetch_assoc($res)) : ?>
				<option value="<?=$ll['ID_PERIODE']?>" <?=$periodeID===$ll['ID_PERIODE']? "selected=\"selected\"" : "" ?> ><?=$ll['ID_PERIODE']?></option>
			<?php endwhile;?>
			</select>
		  </td>
          <td align="left">Status Penilaian :</td>
          <td><select name="stsPenilaian" class="" onchange="penilai_updateTable($('frmSearch')); penilai_updateLevelText($('frmSearch'), $(this.options[this.selectedIndex]).getProperty('level'))">
            <option value="HZ">Horizontal</option>
            <option value="VC">Vertical</option>
          </select></td>
          <td align="left">Jml Level : </td>
          <td><input class="" name="level" type="text" value="" style=" width:30px; background-color:#FFF; border:1px solid #3366CC; color:#000;" disabled="disabled" /></td>
	  </tr>
  </table>
</form> 
<table class="marginT5" style="border:1px solid #457A3F;" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="60px" align="center"><h3><span class="colorWhite">Level</span></h3></th>
    <th align="left"><h3><span class="colorWhite">Nama</span></h3></th>
    <th width="200"><h3><span class="colorWhite">Jabatan</span></h3></th>
    <th width="100" align="center"><h3><span class="colorWhite">Status Penilaian</span></h3></th>
    <th width="50"></th>
  </tr>
  <tbody id="penilai-table"></tbody>
</table>
<!-- penilai.php End-->
