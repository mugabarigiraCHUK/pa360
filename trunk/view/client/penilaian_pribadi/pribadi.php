<?php
$karyID = $_COOKIE_DATA->username;
$levelID = "HZ1";

//load jabatan karyawan dinilai
$kary_data = mysql_fetch_assoc(kary_load($karyID));
$kary_jabatan = mysql_fetch_assoc(RELASIJABATAN_load($karyID, $dep_div_jabID));
?>
<form name="frmDepen" method="post" action="proc/client/penilaian_pribadi.php"> 
<input name="proc" type="hidden" value="detilPenilaian-save" />
<input name="karyID" type="hidden" value="<?=$karyID?>" />
<input name="levelID" type="hidden" value="<?=$levelID?>" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100px">Periode : </td>
    <td>
    	<select name="periodeID" onChange="kriteria($(this).getParent('form'))">
		<?php $PERIODE = periode_select(); ?>
		<?php while ($row = mysql_fetch_assoc($PERIODE)):?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endwhile; ?>
		</select>
    </td>
  </tr>
  <tr>
    <td width="100px">Karyawan dinilai : </td>
    <td><input type="text" value="<?=$kary_data['NAMA_KARYAWAN']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Jabatan : </td>
    <td><select name="dep_div_jabID" onchange="jabatanCombo_change($(this).getParent('form'));"></select></td>
  </tr>
  <tr>
    <td>Departemen  : </td>
    <td><input name="departemen" type="text" value="<?=$kary_jabatan['NAMA_DEPARTMENT']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Divisi : </td>
    <td><input name="divisi" type="text" value="<?=$kary_jabatan['NAMA_DIVISI']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
</table>
<div id="kripen-tab"></div>
</form>