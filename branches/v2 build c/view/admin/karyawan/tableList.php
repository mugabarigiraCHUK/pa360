<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr <?=tag_zebra($z++)?> id="row-<?= $row["KODE_KARYAWAN"] ?>">
    <td align="left"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
    <td align="left"><?= $row["JENIS_KELAMIN"]==0? 'Laki-laki' : 'Perempuan' ?></td>
    <td align="left"><?= $row["EMAIL"] ?></td>
    <td align="right"><?=date_normalize($row['TANGGAL_MASUK'], 'd F Y')?></td>
    <td align="right">
		<a onclick="kary_hstry_jbt('<?= $row["KODE_KARYAWAN"] ?>')">History Jabatan</a><br/>
		<a onclick="click_edit('<?= $row["KODE_KARYAWAN"] ?>')">edit</a>
		<a onclick="click_delete('<?= $row["KODE_KARYAWAN"] ?>')"class="marginL5">delete</a>
    </td>
	<td>&nbsp;</td>
  </tr>
  <?php endwhile;?>