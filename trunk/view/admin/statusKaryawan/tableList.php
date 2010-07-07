<?php $result = stskary_select($key, $orderby)?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
<tr <?php echo tag_zebra($z++)?>>
    <td align="center"><?php echo $row['ID_STATUS_KARYAWAN']?></td>
    <td align="center"><?php echo $row['NAMA_STATUS']?></td>
	<td align="right">
		<a onclick="stskary_edit('<?php echo $row['ID_STATUS_KARYAWAN']?>')">Edit</a>
		<a class="marginL5" onclick="stskary_delete('<?php echo $row['ID_STATUS_KARYAWAN']?>')">Delete</a>
	</td>
</tr>
<?php endwhile; ?>