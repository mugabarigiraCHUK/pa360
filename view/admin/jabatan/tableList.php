<?php $result = jbt_select($key);
	 while ($row = mysql_fetch_assoc($result)):?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$row['ID_JABATAN']?></td>
	<td align="center"><?=$row['NAMA_JABATAN']?></td>
	<td align="center"><?=$row['LEVEL_JABATAN']?></td>
	<td align="center">
		<a onclick="jabatan_edit('<?=$row['ID_JABATAN']?>')">Edit</a>
		<a class="marginL5" onclick="jabatan_delete('<?=$row['ID_JABATAN']?>')">Delete</a></td>
</tr>
<?php endwhile; ?>