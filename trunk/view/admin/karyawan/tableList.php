<?php $result = kary_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)) :?>
  <tr bgcolor="white" id="row-<?= $row["KODE_KARYAWAN"] ?>">
    <td align="center"><?= $row["KODE_KARYAWAN"] ?></td>
    <td><?= $row["NAMA_KARYAWAN"] ?></td>
    <td align="center"><?= $row["JENIS_KELAMIN"]==0? 'Laki-laki' : 'Perempuan' ?></td>
    <td align="center"><?= $row["EMAIL"] ?></td>
    <td align="center"><?= $row["TANGGAL_MASUK"]==='0000-00-00'? '' : date("Y-F-d", strtotime($row["TANGGAL_MASUK"])) ?></td>
    <td align="right">
    	<a onclick="kary_sts_add('<?= $row["KODE_KARYAWAN"] ?>')">Add Status</a>
		<a onclick="kary_sts_history('<?= $row["KODE_KARYAWAN"] ?>')">History Status</a><br/>
		<a onclick="click_edit('<?= $row["KODE_KARYAWAN"] ?>')">edit</a>
		<a onclick="click_delete('<?= $row["KODE_KARYAWAN"] ?>')"class="marginL5">delete</a>
    </td>
  </tr>
  <?php endwhile;?>