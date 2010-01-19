<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr <?=tag_zebra($z++)?> id="row-<?= $row["KODE_KARYAWAN"] ?>">
    <td align="left"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
	<td align="center"><input class="asAdmin" type="checkbox" karyID="<?=$row["KODE_KARYAWAN"]?>" <?=user_isRoleAdmin($row["KODE_KARYAWAN"])? "checked=\"checked\"":""?>  /></td>
    <td align="right"><a onclick="changePassword('<?= $row["KODE_KARYAWAN"] ?>')">change password</a></td>
	<td>&nbsp;</td>
  </tr>
  <?php endwhile;?>