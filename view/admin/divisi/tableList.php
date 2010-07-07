<?php $result = divisi_select($key, $orderby)?>
<?php while ($row = mysql_fetch_assoc($result)):?>
<tr <?php echo tag_zebra($z++)?>>
	<td align="center"><?php echo $row['ID_DIVISI']?></td>
	<td align="center"><?php echo $row['NAMA_DIVISI']?></td>
	<td align="right"><a onclick="divisi_edit('<?php echo $row['ID_DIVISI']?>')">Edit</a><a class="marginL5"
		onclick="divisi_delete('<?php echo $row['ID_DIVISI']?>')">Delete</a></td>
</tr>
<?php endwhile;?>