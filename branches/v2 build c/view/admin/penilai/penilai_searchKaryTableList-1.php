<?php
$search = kary_searchByDepartemen($searchKey, $departemenID);
foreach($search as $row):
?>
<tr <?=tag_zebra($z++)?> ondblclick="penilai_searchKary_pick('<?= $row["KODE_KARYAWAN"] ?>', '<?= $row["NAMA_KARYAWAN"] ?>')" style="cursor:pointer;">
	<td><?= $row["NAMA_KARYAWAN"] ?></td>
	<td align="left"><?= $row["JABATAN"]["NAMA_DIVISI"] ?></td>
	<td align="left"><?= $row["JABATAN"]["NAMA_JABATAN"] ?></td>
	<td align="left"><?= $row["JABATAN"]["LEVEL_JABATAN"] ?></td>
</tr>
<?php endforeach; ?>
