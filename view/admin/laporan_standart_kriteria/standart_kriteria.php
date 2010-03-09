<form name="frmSearch" action="proc/admin/laporan_standart_kriteria.php" method="post">
<input name="proc" type="hidden" value="" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
<tr>
	<td width="100">Periode : </td>
	<td>
		<select name="periodeID" onChange="update_graph($(this).getParent('form'))">
		<?php $PERIODE = periode_select(); ?>
		<?php $periodeID = false ?>
		<?php while ($row = mysql_fetch_assoc($PERIODE)): ?>
		<?php $periodeID = !$periodeID? $row['ID_PERIODE'] : $periodeID ?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endwhile; ?>
		</select>	</td>
</tr>
<tr>
	<td width="100">Level : </td>
	<td>
		<select name="levelID" onChange="update_graph($(this).getParent('form'))">
		<?php $BOBOTLV = bobotlv_select(false, $periodeID); ?>
		<?php $bobotLv = false ?>
		<?php while ($row = mysql_fetch_assoc($BOBOTLV)): ?>
		<?php $bobotLv = !$bobotLv? $row['ID_LEVEL'] : $bobotLv ?>
			<option value="<?=$row['ID_LEVEL']?>"><?=$row['NAMA_LEVEL']?></option>
		<?php endwhile; ?>
		</select>
	</td>
</tr>
<tr>
	<td valign="top">Kriteria : </td>
	<td>
		<table width="100%" border="0" cellpadding="0" cellspacing="5" style="border:1px solid #3366CC;" bgcolor="#FFFFFF">
		<?php 
			$sql="SELECT a.ID_DETIL_BOBOT_LEVEL,
				a.ID_KRITERIA,
				b.NAMA_KRITERIA,
				b.DESKRIPSI,
				a.ID_BOBOT_LEVEL,
				c.ID_PERIODE,
				c.ID_LEVEL,
				c.NAMA_LEVEL,
				c.DESKRIPSI,
				c.BOBOT as BOBOT_LEVEL,
				a.BOBOT
			FROM detil_bobot_level as a, 
				kriteria_penilaian as b, 
				bobot_level as c
			WHERE a.ID_KRITERIA=b.ID_KRITERIA AND a.ID_BOBOT_LEVEL=c.ID_BOBOT_LEVEL
					AND c.ID_PERIODE='$periodeID'
			GROUP BY b.NAMA_KRITERIA
			ORDER BY b.NAMA_KRITERIA";
			
			$DEP = mysql_query($sql);
			$row=true;
		?>
		<?php while ($row):?>
		<tr>
			<?php for($i=0; $i<3; $i++): ?>
			<?php if ($row = mysql_fetch_assoc($DEP)) : ?>
			<td>
			<input name="kripenID[]" type="checkbox" value="<?=$row['ID_KRITERIA']?>" onChange="update_graph($(this).getParent('form'))"/>
			<span class="marginL5"><?=$row['NAMA_KRITERIA']?></span>
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