<form id="frmModal" name="frmModal" method="post" action="proc/penilai.php">
<input name="proc" value="searchKary-table" type="hidden" />
<h2 class="dialog_title"><span>Pencarian Karyawan</span></h2>
<div class="dialog_content" style="padding: 10px 20px">
<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="100" valign="top">Kunci Pencarian : </td>
		<td><input type="text" name="searchKey" style="width:100%" onkeyup="penilai_searchKary_updateTable($('frmModal'))" ></td>
	</tr>
	<tr>
		<td width="100" valign="top">Departemen : </td>
		<td>
			<?php $departemenID = ''; ?>
			<select name="departemenID" onchange="penilai_searchKary_updateTable($('frmModal'))">
				<option value="">--- Semua Departemen ---</option>
				<?php $depart = departemen_select()?>
				<?php while ($dd = mysql_fetch_assoc($depart)):  ?>
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
  <tbody id="searchKary-table" style="overflow:scroll; height:200px" >
  <? include 'penilai_searchKaryTableList-1.php' ?>
  </tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Close"
	name="close" onclick="FBModal_hide()" /></div>
</form>