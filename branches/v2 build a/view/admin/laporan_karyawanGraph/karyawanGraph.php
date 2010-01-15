<form name="frmSearch" action="proc/admin/laporan_karyawanGraph.php" method="post">
<input name="proc" type="hidden" value="" />
<input name="karyID" type="hidden" value="" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">Periode</td>
    <td>
		<select name="periodeStart" onchange="update_periodeCombo($(this).getParent('form'))" class="marginR5">
		<?php $periodeStart = false; ?>
		<?php $PERIODE = periode_select(); ?>
		<?php $periodeCount = mysql_affected_rows() ?>
		<?php for ($i=0; $i<$periodeCount-1; $i++):?>
		<?php		$row = mysql_fetch_assoc($PERIODE); ?>
		<?php		$periodeStart= $periodeStart===false? $row['ID_PERIODE'] : $periodeAwal; ?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endfor; ?>
		</select> <span> - </span>
		<select name="periodeEnd" class="marginL5" onchange="update_graph($(this).getParent('form'))"></select>
	</td>
  </tr>
  <tr>
    <td>Karyawan : </td>
    <td><input type="text" name="karyLabel" class="fake" disabled="disabled" style="width:200px" />
      <input type="button" name="search" value="Search" onclick="searchKary_modal()" /></td>
  </tr>
  <tr>
    <td>Jabatan : </td>
    <td><select name="dep_div_jabID" onchange="updateJabatanDetail($(this).getParent('form')); update_graph($(this).getParent('form'))"></select></td>
  </tr>
  <tr>
    <td>Departemen : </td>
    <td><input type="text" name="departemen" class="fake" disabled="disabled" style="width:200px" /></td>
  </tr>
  <tr>
    <td>Divisi : </td>
    <td><input type="text" name="divisi" class="fake" disabled="disabled" style="width:200px" /></td>
  </tr>
</table>
<table width="100%" border="1">
</table>
</form>
<div class="padT10"></div>
<div>
	<div id="graphIndicator" style="padding:10px 0; margin:auto; display:none" align="center">
	<table width="200px">
	<tbody>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;">Rendering Image...</h3></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div id="graphContainer" align="center"></div>
</div>