<?php $result = jbt_select($key, $orderby);
	 while ($row = mysql_fetch_assoc($result)):?>
<tr <?php echo tag_zebra($z++)?>>
	<td align="center"><?php echo $row['ID_JABATAN']?></td>
	<td align="center"><?php echo $row['NAMA_JABATAN']?></td>
	<td align="center"><?php echo $row['LEVEL_JABATAN']?></td>
	<td align="center">
		<a onclick="jabatan_edit('<?php echo $row['ID_JABATAN']?>')">Edit</a>
		<a class="marginL5" onclick="jabatan_delete('<?php echo $row['ID_JABATAN']?>')">Delete</a></td>
</tr>
<?php endwhile; ?>