<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr <?php echo tag_zebra($z++)?> id="row-<?php echo  $row["KODE_KARYAWAN"] ?>">
    <td align="left"><?php echo  $row["KODE_KARYAWAN"] ?></td>
    <td><?php echo  $row["NAMA_KARYAWAN"] ?></td>
	<td align="center"><input class="asAdmin" type="checkbox" karyID="<?php echo $row["KODE_KARYAWAN"]?>" <?php echo user_isRoleAdmin($row["KODE_KARYAWAN"])? "checked=\"checked\"":""?>  /></td>
    <td align="right"><a onclick="changePassword('<?php echo  $row["KODE_KARYAWAN"] ?>')">reset password</a></td>
	<td>&nbsp;</td>
  </tr>
  <?php endwhile;?>