<?php $result = bobotlv_select(false, $periodeID); ?>
<?php while ($row = mysql_fetch_assoc($result)): ?>
<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
	<td align="left"><?=$row['ID_LEVEL']?></td>
	<td align="left"><?=$row['NAMA_LEVEL']?></td>
	<td align="center"><?=$row['BOBOT']?></td>
	<td><?=$row['DESKRIPSI']?></td>
	<td align="right"><a onClick="bobotLevel_edit('<?=$row['ID_BOBOT_LEVEL']?>')">Edit</a></td>
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