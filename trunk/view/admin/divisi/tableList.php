<?php $result = divisi_select($key)?>
<?php while ($row = mysql_fetch_assoc($result)):?>
<tr <?=tag_zebra($z++)?>>
	<td align="center"><?=$row['ID_DIVISI']?></td>
	<td align="center"><?=$row['NAMA_DIVISI']?></td>
	<td align="right"><a onclick="divisi_edit('<?=$row['ID_DIVISI']?>')">Edit</a><a class="marginL5"
		onclick="divisi_delete('<?=$row['ID_DIVISI']?>')">Delete</a></td>
</tr>
<?php endwhile;?>