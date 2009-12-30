<?php

$result = kary_search($searchKey);
while ($row = mysql_fetch_assoc($result) ):
	$karyData = kary_load_complete($row["KODE_KARYAWAN"]);
	
	//cek apakah status kerja NON AKTIF
	if  (strtolower($karyData['STATUS_KERJA']['NAMA_STATUS']) === strtolower("Non Aktif") ) {
		continue;
	}
	
	//bandingkan jabatannya
	$jbtFound = false;
	foreach($karyData['JABATAN'] as $jbt){
		$jbtFound = $departemenID === $jbt["ID_DEPARTMENT"]? $jbt : $jbtFound;
	}
	
	//jika jabatan ditemukan, print
	if ($jbtFound && 
		( preg_match('/('.$searchKey.')/i', $jbtFound['KODE_KARYAWAN']) || 
		  preg_match('/('.$searchKey.')/i', $jbtFound['NAMA_KARYAWAN']) ) ):
?>

<tr bgcolor="white" ondblclick="penilai_searchKary_pick('<?= $row["KODE_KARYAWAN"] ?>', '<?= $row["NAMA_KARYAWAN"] ?>')" style="cursor:pointer;">
	<td><?= $karyData["NAMA_KARYAWAN"] ?></td>
	<td align="left"><?= $jbtFound["NAMA_DIVISI"] ?></td>
	<td align="left"><?= $jbtFound["NAMA_JABATAN"] ?></td>
	<td align="left"><?= $jbtFound["LEVEL_JABATAN"] ?></td>
</tr>
	<?php endif; ?>
<?php endwhile; ?>
