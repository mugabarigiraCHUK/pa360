<?php $result = kripen_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) : ?>
	<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
	<td width="100px" align="center"><?=$row['ID_KRITERIA']?></td>
	<td align="left"><?=$row['NAMA_KRITERIA']?></td>
	<td align="left"><?=substr($row['DESKRIPSI'],0,200)?></td>
	<td align="right">
		<a onClick="kripen_edit('<?=$row['ID_KRITERIA']?>')">Edit</a>
		<a class="marginL5" onClick="kripen_delete('<?=$row['ID_KRITERIA']?>')">Delete</a>
	</td>
	<td>&nbsp;</td>
</tr>
<?php endwhile; ?>
<!--<tr class="header">
	<th align="center"><h3><span class="colorWhite">TOTAL</span></h3></th>
	<th align="left"></th>
	<th align="center"><h3><span class="colorWhite"><?=$total?>%</span></h3></th>
	<th align="left"></th>
	<th align="right"></th>
</tr>-->