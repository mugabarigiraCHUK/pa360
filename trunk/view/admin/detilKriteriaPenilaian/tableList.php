<?php $result = dekripen_select($kripenID, false, $key); ?>
<?php while ($row = mysql_fetch_assoc($result)) : ?>
	<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
    <td width="150" align="left"><?=$row['NAMA_KRITERIA']?></td>
    <td width="100" align="center"><?=$row['ID_DETAIL_KRITERIA']?></td>
    <td width="150" align="left"><?=$row['NAMA_DETAIL_KRITERIA']?></td>
    <td width="100" align="center"><?=$row['BOBOT']?></td>
    <td width="" align="left"><?=substr($row['DESKRIPSI'],0,100) . (strlen($row['DESKRIPSI'])>100? ' ...' : '')?></td>
    <td width="100" align="right">
		<a onClick="dekripen_edit('<?=$row['ID_DETAIL_KRITERIA']?>')">Edit</a>
		<a class="marginL5" onClick="dekripen_delete('<?=$row['ID_DETAIL_KRITERIA']?>')">Delete</a>
	</td>
</tr>
<?php endwhile; ?>
<tr class="header">
	<th align="center"><h3><span class="colorWhite">TOTAL</span></h3></th>
	<th align="left"></th>
	<th align="left"></th>
	<th align="left"></th>
	<th align="center"><h3><span class="colorWhite"><?=$total?>%</span></h3></th>
	<th align="left"></th>
</tr>