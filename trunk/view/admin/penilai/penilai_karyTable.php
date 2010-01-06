<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr bgcolor="white" id="row-<?= $row["KODE_KARYAWAN"] ?>">
    <td align="center"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
    <td align="center"><?= $row["JENIS_KELAMIN"]==0? 'Laki-laki' : 'Perempuan' ?></td>
    <td align="center"><?= $row["EMAIL"] ?></td>
    <td align="center"><?= date("Y-F-d", strtotime($row["TANGGAL_MASUK"])) ?></td>
    <td align="right"><a onclick="penilai_setPenilai('<?= $row["KODE_KARYAWAN"] ?>')">set Penilai</a></td>
  </tr>
  <?php endwhile;?>