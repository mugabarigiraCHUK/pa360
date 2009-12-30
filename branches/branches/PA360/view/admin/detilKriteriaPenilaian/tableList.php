<?php $result = dekripen_select($kripenID, false, $key); ?>
<?php while ($row = mysql_fetch_assoc($result)) : ?>
	<?php $total += $row['BOBOT']; ?>
<tr <?=tag_zebra($z++)?>>
    <td width="100px" align="center"><?=$row['ID_KRITERIA']?></td>
    <td width="150px" align="left"><?=$row['NAMA_KRITERIA']?></td>
    <td width="100px" align="center"><?=$row['ID_DETAIL_KRITERIA']?></td>
    <td width="150px" align="left"><?=$row['NAMA_DETAIL_KRITERIA']?></td>
    <td width="100px" align="center"><?=$row['BOBOT']?></td>
    <td width="" align="left"><?=$row['DESKRIPSI']?></td>
    <td width="100px" align="right">
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
	<th align="right"></th>
</tr>