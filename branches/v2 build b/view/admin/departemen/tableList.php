<?php $result = departemen_select($key)?>
<?php while ($row = mysql_fetch_assoc($result)):?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$row['ID_DEPARTMENT']?></td>
	<td align="center"><?=$row['NAMA_DEPARTMENT']?></td>
	<td align="right"><a onclick="departemen_edit('<?=$row['ID_DEPARTMENT']?>')">Edit</a><a class="marginL5"
		onclick="departemen_delete('<?=$row['ID_DEPARTMENT']?>')">Delete</a></td>
</tr>
<?php endwhile;?>
