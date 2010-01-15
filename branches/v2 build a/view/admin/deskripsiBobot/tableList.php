<?php $result = debot_select(false, $dekripenID, $key, 'NILAI ASC'); ?>
<?php while ($row = mysql_fetch_assoc($result)) : ?>
<tr <?=tag_zebra($z++)?>>
	<td><?=$row['NAMA_DETAIL_KRITERIA']?></td>
	<td align="center"><?=$row['NILAI']?></td>
	<td align="left"><?=$row['DESKRIPSI']?></td>
	<td width="100px" align="right">
		<a onClick="debot_edit('<?=$row['NILAI']?>', '<?=$row['ID_DETAIL_KRITERIA']?>')">Edit</a>
		<a class="marginL5" onClick="debot_delete(<?=$row['NILAI']?>, '<?=$row['ID_DETAIL_KRITERIA']?>')">Delete</a>
	</td>
</tr>
<?php endwhile; ?>