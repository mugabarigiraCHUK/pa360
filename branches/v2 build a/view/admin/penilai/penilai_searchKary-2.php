<form id="frmModal" name="frmModal" method="post" action="proc/penilai.php">
<input name="proc" value="searchKary2-table" type="hidden" />
<input name="karyID" type="hidden" value="<?=$karyID?>" />
<input name="dep_div_jabID" type="hidden" value="<?=$dep_div_jabID?>" />
<input name="periodeID" type="hidden" value="<?=$periodeID?>" />
<input name="stsPenilaian" type="hidden" value="<?=$stsPenilaian?>" />
<input name="searchKey" type="hidden" value="<?=$searchKey?>" />
<h2 class="dialog_title"><span>Pencarian Karyawan</span></h2>
<div class="dialog_content" style="padding: 10px 20px">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="100" valign="top">Kunci Pencarian : </td>
		<td width=""><input type="text" name="searchKey" style="width:85%" onkeyup="penilai_searchKary_updateTable2($('frmModal'))" ></td>
	</tr>
	<tr>
		<td width="150" valign="top">Departemen : </td>
		<td>
			<?php $departemenID = ''; ?>
			<select name="departemenID" onchange="penilai_searchKary_updateTable2($('frmModal'))">
				<?php $depart = departemen_select()?>
				<?php while ($dd = mysql_fetch_assoc($depart)):  ?>
					<?php if ($departemenID==='') $departemenID = $dd['ID_DEPARTMENT']; ?>
				<option value="<?=$dd['ID_DEPARTMENT']?>"><?=$dd['NAMA_DEPARTMENT']?></option>
				<?php endwhile;?>
			</select>
		</td>
	</tr>
</table>
<table style="border:1px solid #457A3F;" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th align="left"><h3><span class="colorWhite">Nama</span></h3></th>
	<th align="left"><h3><span class="colorWhite">Divisi</span></h3></th>
	<th align="left"><h3><span class="colorWhite">Jabatan</span></h3></th>
	<th align="left"><h3><span class="colorWhite">Level</span></h3></th>
  </tr>
  <tbody id="searchKary2-table" style="overflow:scroll; height:200px">
  <? include 'penilai_searchKaryTableList-2.php' ?>
  </tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Close"
	name="close" onclick="FBModal_hide()" /></div>
</form>