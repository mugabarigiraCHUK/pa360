<?php $result = searchKaryawan_untukPenilai($karyID, $dep_div_jabID, $stsPenilaian, $departemenID, $searchKey);?>
<?php foreach ($result as $row):?>
<tr bgcolor="white" ondblclick="penilai_searchKary_pick2('<?= $row["KODE_KARYAWAN"] ?>', '<?= $row["NAMA_KARYAWAN"] ?>', '<?= $row["JABATAN"]["ID_DEP_DIV_JAB"] ?>', '<?= $row["JABATAN"]["NAMA_JABATAN"] ?>', '<?= $row["JABATAN"]["NAMA_DEPARTMENT"] ?>', '<?= $row["JABATAN"]["NAMA_DIVISI"] ?>')" style="cursor:pointer;">
	<td><?= $row["NAMA_KARYAWAN"] ?></td>
	<td><?= $row["JABATAN"]['NAMA_DIVISI'] ?></td>
	<td><?= $row["JABATAN"]['NAMA_JABATAN'] ?></td>
	<td><?= $row["JABATAN"]['LEVEL_JABATAN'] ?></td>
</tr>
<?php endforeach; ?>

<?php 
function searchKaryawan_untukPenilai2($karyID, $dep_div_jabID, $stsPenilaian, $departemenID, $searchKey){
	$karyInc = array();	//kumpulkan disini hasil pencarian
	
	$rsJabatan = RELASIJABATAN_load();
}


/**
 * 
 * @param $karyID (string) - kode karyawan
 * @param $dep_div_jabID (string) - kode relasi karyawan
 * @param $stsPenilaian (string) - HORIZONTAL (HZ)/ Vertical (VC)
 */
function searchKaryawan_untukPenilai($karyID, $dep_div_jabID, $stsPenilaian, $departemenID, $searchKey){
	$karyInc = array();	//kumpulkan disini hasil pencarian
	
	//load relasi jabatan untuk karyawan $karyID
	$rsJabatan = RELASIJABATAN_load($karyID);
	while ($xx = mysql_fetch_assoc($rsJabatan)){
		
		//bandingkan $dep_div_jabID
		if ($xx['ID_DEP_DIV_JAB'] !== $dep_div_jabID) { continue; }
		
		//load semua data jabatan
		$rsJabatan2 = RELASIJABATAN_load();
		while( $row = mysql_fetch_assoc($rsJabatan2) ){	
			//cek '$karyID' apakah sama dengan karyawan source, abaikan !!!!
			if ($karyID === $row['KODE_KARYAWAN']) { continue; }
		
			/**
			 * lihat level jabatannya, cari sesuai $stsPenilaian. 
			 * contoh, jika $stsPenilaian = 'HZ' ---> horizontal
			 * maka lihat matrix level jabatan (x,y) pad bagian 'y'.
			 * 
			 * contoh, jika $stsPenilaian = 'VC' ---> vertikal
			 * maka lihat matrix level jabatan (x,y) pad bagian 'x'.
			 */
			//asumsikan level berisi matrix (x,y), pisahkan koma
			$lvJabatan = explode(".",$xx['LEVEL_JABATAN']);
		
			//selanjutnya cari sesuai dengan ketentuan '$stsPenilaian'
			//load semua relasi jabatan. untuk 1 karyID (karyawan) bisa lebih dari 1 jabatan, jadi kumpulkan dulu
			//cek level vertikal atau horizontal
			$rowex = explode(".", $row['LEVEL_JABATAN']);
			if ($stsPenilaian==='HZ'){
				if ($rowex[0]===$lvJabatan[0]){
					$karyInc[] = array(
						'KODE_KARYAWAN'=> $row['KODE_KARYAWAN'],
						'ID_DEP_DIV_JAB'=> $row['ID_DEP_DIV_JAB'],);
				}
			}
			else if ($stsPenilaian==='VC'){
				if ($rowex[0]!==$lvJabatan[0]){
					$karyInc[] = array(
						'KODE_KARYAWAN'=> $row['KODE_KARYAWAN'],
						'ID_DEP_DIV_JAB'=> $row['ID_DEP_DIV_JAB'],);
				}
			}
			else{ continue; }
			
		}
		mysql_free_result($rsJabatan2);
	}
	mysql_free_result($rsJabatan);
	
	//debug
	//return $karyInc;
	
	//sampe sini, hasilnya terkumpul pada variabel '$karyInc'
	//lakukan filter lagi untuk :
	//		$key --->  (kunci pencarian)
	//		statusKerja ---> NON AKTIF
	$result = array();
	foreach($karyInc as $kk){
		//cek apakah sudah ada dalam '$result'
		//if ( array_key_exists($kk, $result) ){ continue; }
	
		//cek status, cari yang bukan 'NON AKTIF' dan
		$kary = kary_load_complete( $kk['KODE_KARYAWAN'] );
		if ( strtolower($kary['NAMA_STATUS']) == strtolower('NON AKTIF') ) {
			continue;
		}
		
		//cek apakah sesuai dengan '$departemenID'
		$found = false;
		$jbt = RELASIJABATAN_load($kk['KODE_KARYAWAN'], $kk['ID_DEP_DIV_JAB']);
		$jbt = mysql_fetch_assoc($jbt);
		$found = $departemenID === $jbt["ID_DEPARTMENT"]? TRUE : FALSE;
		if (! $found) { continue; } //tidak ditemukan, lanjutkan loop
		$kary['JABATAN'] = $jbt;
		
		//cek apakah sesuai dengan '$searchKey' nama karyawann atau kodenya
		if ( !preg_match('/('.$searchKey.')/i', $kary['NAMA_KARYAWAN']) ||  
			 !preg_match('/('.$searchKey.')/i', $kary['KODE_KARYAWAN'])  ){		 
			continue;
		}
		
		//sampai sini, asumsikan semua kondisi diatas terpenuhi
		//simpan...
		$result[$kk['KODE_KARYAWAN']] = $kary;
	}
	
	return $result;
}
?>