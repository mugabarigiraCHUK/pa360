<?php $res = detilStatusKaryawan_select($karyID)?>
<?php while ($row= mysql_fetch_assoc($res)) : ?>
<tr>
	<td align="center"><?=$row['NAMA_STATUS']?></td>
	<td align="center"><?=$row['TGL_UPDATE_STATUS']?></td>
	<td align="left"><a onClick="kary_sts_delete('<?=$karyID?>','<?=$row['ID_STATUS_KARYAWAN']?>','<?=$row['TGL_UPDATE_STATUS']?>')">Delete</a></td>
</tr>
<?php endwhile;?>