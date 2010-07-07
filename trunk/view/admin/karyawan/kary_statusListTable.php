<?php $res = detilStatusKaryawan_select($karyID)?>
<?php while ($row= mysql_fetch_assoc($res)) : ?>
<tr>
	<td align="center"><?php echo $row['NAMA_STATUS']?></td>
	<td align="center"><?php echo date('Y-F-d h:m:s', strtotime($row['TGL_UPDATE_STATUS']))?></td>
	<td align="left"><a onClick="kary_sts_delete('<?php echo $karyID?>','<?php echo $row['ID_STATUS_KARYAWAN']?>','<?php echo $row['TGL_UPDATE_STATUS']?>')">Delete</a></td>
</tr>
<?php endwhile;?>