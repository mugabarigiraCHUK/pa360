<?php $result = bobotlv_select($periodeID); ?>
<?php while ($row = mysql_fetch_assoc($result)): ?>
<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$row['ID_LEVEL']?></td>
	<td align="center"><?=$row['NAMA_LEVEL']?></td>
	<td align="center"><?=$row['BOBOT']?></td>
	<td><?=$row['DESKRIPSI']?></td>
	<td align="right">
		<a onClick="bobotLevel_edit('<?=$row['ID_PERIODE']?>','<?=$row['ID_LEVEL']?>')">Edit</a>
		<!--<a class="marginL5" onclick="bobotLevel_kriteria('<?=$row['ID_PERIODE']?>','<?=$row['ID_LEVEL']?>')">Kriteria</a>--></td>
</tr>
<?php endwhile; ?>
<tr class="header">
	<td colspan="2" align="left"><h3><span class="colorWhite">Total</span></h3><span class="colorWhite">(horizontal + vertical)</span></td>
	<td align="center"><h3><span class="colorWhite"><?=$total?>%</span></h3></td>
	<td></td>
	<td></td>
</tr>
<script>
function getBobotLevelTotal(){return <?=$total?>;}
</script>