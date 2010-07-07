<?php $result = golongan_select($key, $orderby)?>
<?php while ($row = mysql_fetch_assoc($result)):?>
<tr <?php echo tag_zebra($z++)?>>
	<td align="center"><?php echo $row['ID_GOLONGAN']?></td>
	<td align="center"><?php echo $row['NAMA_GOLONGAN']?></td>
	<td align="center">
		<a onclick="golongan_edit('<?php echo $row['ID_GOLONGAN']?>')">Edit</a><a class="marginL5"
		onclick="golongan_delete('<?php echo $row['ID_GOLONGAN']?>')">Delete</a></td>
</tr>
<?php endwhile;?>