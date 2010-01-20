<?php $result = stskary_select($key)?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
<tr <?=tag_zebra($z++)?>>
    <td align="center"><?=$row['ID_STATUS_KARYAWAN']?></td>
    <td align="center"><?=$row['NAMA_STATUS']?></td>
	<td align="right">
		<a onclick="stskary_edit('<?=$row['ID_STATUS_KARYAWAN']?>')">Edit</a>
		<a class="marginL5" onclick="stskary_delete('<?=$row['ID_STATUS_KARYAWAN']?>')">Delete</a>
	</td>
</tr>
<?php endwhile; ?>