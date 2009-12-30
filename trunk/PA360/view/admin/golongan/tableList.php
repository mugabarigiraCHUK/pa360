<?php $result = golongan_select($key)?>
<?php while ($row = mysql_fetch_assoc($result)):?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$row['ID_GOLONGAN']?></td>
	<td align="center"><?=$row['NAMA_GOLONGAN']?></td>
	<td align="center">
		<a onclick="golongan_edit('<?=$row['ID_GOLONGAN']?>')">Edit</a><a class="marginL5"
		onclick="golongan_delete('<?=$row['ID_GOLONGAN']?>')">Delete</a></td>
</tr>
<?php endwhile;?>