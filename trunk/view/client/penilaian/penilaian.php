<?php 
//init
$karyID = $_COOKIE_DATA->username;
?>
<form id="frmSearch" name="frmSearch" method="post" action="proc/client/penilaian.php">
	<input type="hidden" name="proc" value="dinilai-table" />
	<input type="hidden" name="karyID" value="<?=$karyID?>" />
  <table width="100%" border="0" cellpadding="3" cellspacing="0">
    <tr>
		<td width="100">Periode : </td>
		<td>
			<select id="periodeID" name="periodeID">
			<?php $periodeID = $_REQUEST['periodeID']; ?>
			<?php $pp = periode_select()?>
			<?php while ($row = mysql_fetch_assoc($pp)): ?>
			<?php if ($periodeID==='' || !isset($periodeID)) $periodeID = $row['ID_PERIODE']; ?>
				<option value="<?=$row['ID_PERIODE']?>" <?=$row['ID_PERIODE']===$periodeID? "selected=\"selected\"" : ""?> ><?=$row['ID_PERIODE']?></option>
			<?php endwhile;?>
			</select>		
		</td>
    </tr>
    <tr>
      	<td>Jabatan : </td>
		<td>
			<select name="dep_div_jabID" id="dep_div_jabID" onchange="jbt_comboEvent(this)">
			<?php $dep_div_jabID = $_REQUEST['dep_div_jabID']; ?>
			<?php $rsjab = RELASIJABATAN_load($karyID)?>
			<?php while ($row = mysql_fetch_assoc($rsjab)):?>
			<option value="<?=$row['ID_DEP_DIV_JAB']?>" divisi="<?=$row['NAMA_DIVISI']?>" departemen="<?=$row['NAMA_DEPARTMENT']?>" <?=$row['ID_DEP_DIV_JAB']===$dep_div_jabID? "selected=\"selected\"" : ""?>><?=$row['NAMA_JABATAN']?></option>
			<?php endwhile;?>
			</select>
		</td>
    </tr>
    <tr>
      <td>Departemen : </td>
      <td><input name="departemen" type="text" id="departemen" disabled="disabled" style="width:200;" class="fake" /></td>
    </tr>
    <tr>
      <td>Divisi : </td>
      <td><input name="divisi" type="text" id="divisi" disabled="disabled" style="width:200; " class="fake" /></td>
    </tr>
  </table>
</form>
  <table width="100%" border="0" cellpadding="5" cellspacing="0" class="list marginT5">
    <tr class="header">
      <th align="left"><h3><span class="colorWhite">Nama Karyawan</span></h3></th>
      <th align="left"><h3><span class="colorWhite">Jabatan</span></h3></th>
      <th align="left"><h3><span class="colorWhite">Departemen</span></h3></th>
      <th align="left"><h3><span class="colorWhite">Divisi</span></h3></th>
      <th align="center"><h3><span class="colorWhite">Level Penilaian</span></h3></th>
      <th>&nbsp;</th>
    </tr>
	<tbody id="dinilai-table" style="overflow: hidden; overflow-y: scroll; height: 400px;"></tbody>
</table>
