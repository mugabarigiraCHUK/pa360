<form name="frmSearch" action="proc/admin/laporan_rataKinerjaGraph.php" method="post">
<input name="proc" type="hidden" value="" />
<div class="padT5">Periode :
	<select name="periodeStart" onchange="update_periodeCombo($(this).getParent('form'))" class="marginL5 marginR5">
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
</div>
</form>
<div class="padT10"></div>
<div>
	<div id="graphIndicator" style="padding:10px 0; margin:auto; display:none;" align="center">
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