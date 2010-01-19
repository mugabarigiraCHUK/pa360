<form name="frmSearch" action="proc/admin/laporan_departemenGraph.php" method="post">
<input name="proc" type="hidden" value="" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
	<td width="100">Periode : </td>
	<td>
		<select name="periodeID" onChange="update_graph($(this).getParent('form'))">
		<?php $PERIODE = periode_select(); ?>
		<?php while ($row = mysql_fetch_assoc($PERIODE)):?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endwhile; ?>
		</select>	</td>
</tr>
<tr>
	<td valign="top">Departemen : </td>
	<td>
		<table width="100%" border="0" cellpadding="0" cellspacing="5" style="border:1px solid #3366CC;" bgcolor="#FFFFFF">
		<?php $DEP = departemen_select(false, "NAMA_DEPARTMENT ASC"); $row=true; ?>
		<?php while ($row):?>
		<tr>
			<?php for($i=0; $i<3; $i++): ?>
			<?php if ($row = mysql_fetch_assoc($DEP)) : ?>
			<td>
			<input name="departemenID[]" type="checkbox" value="<?=$row['ID_DEPARTMENT']?>" onChange="update_graph($(this).getParent('form'))"/>
			<span class="marginL5"><?=$row['NAMA_DEPARTMENT']?></span>
			</td>
			<?php else: ?><td></td>
			<?php endif;?>
			<?php endfor;?>
		</tr>
		<?php endwhile; ?>
		</table>
	</td>
</tr>
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