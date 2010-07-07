<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr <?php echo tag_zebra($z++)?> id="row-<?php echo  $row["KODE_KARYAWAN"] ?>">
    <td align="left"><?php echo  $row["KODE_KARYAWAN"] ?></td>
    <td><?php echo  $row["NAMA_KARYAWAN"] ?></td>
    <td align="left"><?php echo  $row["JENIS_KELAMIN"]==0? 'Laki-laki' : 'Perempuan' ?></td>
    <td align="left"><?php echo  $row["EMAIL"] ?></td>
    <td align="right"><?php echo date_normalize($row['TANGGAL_MASUK'], 'd F Y')?></td>
    <td align="right">
		<a onclick="kary_hstry_jbt('<?php echo  $row["KODE_KARYAWAN"] ?>')">History Jabatan</a><br/>
		<a onclick="click_edit('<?php echo  $row["KODE_KARYAWAN"] ?>')">edit</a>
		<a onclick="click_delete('<?php echo  $row["KODE_KARYAWAN"] ?>')"class="marginL5">delete</a>
    </td>
	<td>&nbsp;</td>
  </tr>
  <?php endwhile;?>