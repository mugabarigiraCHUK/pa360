<?php $result = debotlv_select(false, $periodeID, $levelID); ?>
<?php while ($row = mysql_fetch_assoc($result)) : ?>
	<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
	<td width="100" align="center"><?=$row['ID_KRITERIA']?></td>
	<td align="left"><?=$row['NAMA_KRITERIA']?></td>
	<td align="center"><?=$row['BOBOT']?></td>
	<td align="right">
		<a class="marginL5" onClick="debotlv_edit('<?=$row['ID_DETIL_BOBOT_LEVEL']?>')">Edit</a>
		<a class="marginL5" onClick="debotlv_delete('<?=$row['ID_DETIL_BOBOT_LEVEL']?>')">Delete</a>
	</td>
</tr>
<?php endwhile; ?>
<?php if ($z==0) :?>
<tr <?=tag_zebra($z++)?>><td height="30" colspan="3" align="center"><h3>No Data</h3></td><td></td></tr>
<?php endif;?>
<tr class="header">
	<th align="center"><h3><span class="colorWhite">TOTAL</span></h3></th>
	<th align="left"></th>
	<th align="center"><h3><span class="colorWhite"><?=intval($total)?>%</span></h3></th>
	<th align="right"></th>
</tr>