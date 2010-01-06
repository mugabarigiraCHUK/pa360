<?php
include 'karyawan-relasi.php';
include 'detilStatusKaryawan.php';
include 'alamat.php';
include 'telepon.php';

/**
 * SELECT ALL DATA
 */
function kary_select($key=""){
	global $_CON;
	$result = kary_search($key);
	return !$result? mysql_error() : $result;
}

/**
 * CEK Kode karyawan
 * @param $kode
 */
function kary_isExistCode($kode){
	$sql = "select count(kode_karyawan) as KODE ".
			"from data_karyawan ".
			"where kode_karyawan='$kode'";
	$result = mysql_fetch_assoc(mysql_query($sql));
	return $result['KODE']>0? true : false;
}

/**
 * SEARCH DATA BERDASARKAN KODE ATAU NAMA KARYAWAN
 * @param unknown_type $search
 */
function kary_search($search){
	global $_CON;
	$sql = "select * ".
			"from data_karyawan ".
			"where kode_karyawan like '%$search%' OR nama_Karyawan like '%$search%'";
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

/**
 * ambil data karyawan
 * @param $kode (string) kode karyawan
 */
function kary_load($kode){
	$sql = "select * from data_karyawan where kode_karyawan='$kode'";
	return mysql_query($sql);
}

/**
 * 
 * @param $kode 
 * @param $nama
 * @param $tmplahir
 * @param $tgllahir
 * @param $jnskelamin
 * @param $goldarah
 * @param $status
 * @param $agama
 * @param $email
 * @param $tglmasuk
 * @param $tglkeluar
 */
function kary_insert($kode, $nama, $tmplahir, $tgllahir, $jnskelamin, $goldarah, 
					$status, $agama, $email, $tglmasuk, $tglkeluar){
	$sqlKary = "insert into data_karyawan 
		values ('$kode', '$nama', '$tmplahir',
			  '$tgllahir',
			  $jnskelamin, '$goldarah', '$status',
			  '$agama', '$email',
			  '$tglmasuk',
			  '$tglkeluar')";
	
	if (! mysql_query($sqlKary)){
		return false;
	}
	
	/**
	 * saving
	 */
	return true;
}

/**
 * UPADATE DATA KARYAWAN
 */
function kary_update($kode, $nama, $tmplahir, $tgllahir, $jnskelamin, $goldarah, 
					$status, $agama, $email, $tglmasuk, $tglkeluar){
	$sql = "update data_karyawan set 
				nama_karyawan = '$nama', 
				Tempat_Lahir = '$tmplahir', 
				Tanggal_Lahir = '$tgllahir', 
				Jenis_Kelamin = $jnskelamin, 
				Golongan_Darah = '$goldarah',
				Status = '$status', 
				Agama = '$agama', 
				Email = '$email', 
				Tanggal_masuk = '$tglmasuk', 
				Tanggal_keluar = '$tglkeluar'
			where kode_karyawan = '$kode'";
	return mysql_query($sql);
}

/**
 * DELETE DATA KARYAWAN
 * @param $kode (string) - kode karyawan
 */
function kary_delete($kode){
	$sql = "delete from data_karyawan where kode_karyawan='" . $kode . "'";
	return mysql_query($sql);
}

function kary_insert_complete($karyawan, $alamat, $tlp, $job, $gol){
	//save karyawan
	if (! kary_insert($karyawan['kode'], $karyawan['nama'], $karyawan['tmLahir'], $karyawan['tglLahir'], 
				$karyawan['kelamin'], $karyawan['darah'], $karyawan['status'], $karyawan['agama'], 
				$karyawan['email'], $karyawan['tglMasuk'], $karyawan['tglKeluar'])){
		return false;				
	}
	
	//save alamat
	foreach ($alamat as $l){
		if (! alamat_insert(++$countID, $karyawan['kode'], $l['alamat'], $l['kodePos'], 
				$l['kodeArea'], $l['kota'], $l['propinsi'])){
			return false;
		}
	}
	
	//save tlp
	foreach ($tlp as $k){
		if (! tlp_insert($karyawan['kode'], $k)){
			return false;
		}
	}
	
	//save jabatan
	foreach ($job as $k){
		$uq = microtime();	//primary key
		if (! (DEPDIVJAB_insert($uq, $k['jabatan'], $k['divisi'], $k['departemen']) && 
			RELASIDIVJABDIN_insert($karyawan['kode'], $k['tglMenjabat'],$k['tglBerhenti'], $uq)) ){
				return false;
		}
	}
	
	//save golongan
	foreach ($gol as $k){
		if (! RELASIGOLONGAN_isExist($k['golongan'], $karyawan['kode'])){
			if (! RELASIGOLONGAN_insert($k['golongan'], $karyawan['kode'], 
					$k['tglMenjabat'],$k['tglBerhenti'])){
				return false;			
			}
		}
	}
	
	return true;
}

function kary_update_complete($karyawan, $alamat, $tlp, $job, $gol){
	//update karyawan
	if (! kary_update($karyawan['kode'], $karyawan['nama'], $karyawan['tmLahir'], $karyawan['tglLahir'], 
				$karyawan['kelamin'], $karyawan['darah'], $karyawan['status'], $karyawan['agama'], 
				$karyawan['email'], $karyawan['tglMasuk'], $karyawan['tglKeluar'])){
		return false;
	}
	
	/**
	 * update alamat
	 */
	//delete data alamat lama
	alamat_delete($karyawan['kode']);
	//insert yang baru
	foreach ($alamat as $l){
		if (! alamat_insert(++$countID, $karyawan['kode'], $l['alamat'], $l['kodePos'], 
				$l['kodeArea'], $l['kota'], $l['propinsi'])){
			return false;
		}
	}
	
	/**
	 * update tlp
	 */
	//delete data tlp lama
	tlp_delete($karyawan['kode']);
	//insert tlp baru
	foreach ($tlp as $k){
		if (! tlp_insert($karyawan['kode'], $k)){
			return false;
		}
	}
	
	/**
	 * update jabatan
	 * FIXME: delete relasi div_jab_din dan dep_div_jab bisa mengakibatkan hilangnya reference
	 */
	//delete jabatan lama
	$jab = mysql_fetch_assoc(RELASIJABATAN_load($karyawan['kode']));
	$idDEPDIVJAB = $jab['ID_DEP_DIV_JAB'];
	RELASIDIVJABDIN_delete($karyawan['kode']);
	DEPDIVJAB_delete($idDEPDIVJAB);
	//save jabatan baru
	foreach ($job as $k){
		$uq = microtime();	//primary key
		if (! (DEPDIVJAB_insert($uq, $k['jabatan'], $k['divisi'], $k['departemen']) && 
			RELASIDIVJABDIN_insert($karyawan['kode'], $k['tglMenjabat'],$k['tglBerhenti'], $uq)) ){
				return false;
		}
	}
	
	/**
	 * update golongan
	 */
	//delete data golongan lama
	RELASIGOLONGAN_delete($karyawan['kode']);
	//save golongan
	foreach ($gol as $k){
		if (! RELASIGOLONGAN_isExist($k['golongan'], $karyawan['kode'])){
			if (! RELASIGOLONGAN_insert($k['golongan'], $karyawan['kode'], 
					$k['tglMenjabat'],$k['tglBerhenti'])){
				return false;			
			}
		}
	}
	
	return true;
}

function kary_delete_complete($karyID){
	kary_delete($karyID);	//delete karyawan
	alamat_delete($karyID);	//delelte alamat
	tlp_delete($karyID); //delete tlp
	RELASIGOLONGAN_delete($karyID); //delete golongn
	
	//delete jabatan
	$jab = mysql_fetch_assoc(RELASIJABATAN_load($karyID));
	$idDEPDIVJAB = $jab['ID_DEP_DIV_JAB'];
	RELASIDIVJABDIN_delete($karyID);
	DEPDIVJAB_delete($idDEPDIVJAB);
	
	return true;
}

function kary_load_complete($karyID){
	$rsKary = mysql_fetch_assoc(kary_load($karyID));
	$kary = $rsKary;
	
	//append alamat
	$rsAlamat = alamat_load($kary['KODE_KARYAWAN']);
	$alamat = array();
	while ($alm = mysql_fetch_assoc($rsAlamat)){
		$alamat[] = $alm;
	}
	$kary['ALAMAT'] = $alamat;
	mysql_free_result($rsAlamat);
	
	//append tlp
	$rsTlp = tlp_load($kary['KODE_KARYAWAN']);
	$telpon = array();
	while ($tlp = mysql_fetch_assoc($rsTlp)){
		$telpon[] = $tlp;
	}
	$kary['TELPON'] = $telpon;
	mysql_free_result($rsTlp);
	
	//append golongan
	$rsGol = RELASIGOLONGAN_load($kary['KODE_KARYAWAN']);
	$gol = array();
	while ($gg = mysql_fetch_assoc($rsGol)){
		$gol[] = $gg;
	}
	$kary['GOLONGAN'] = $gol;
	mysql_free_result($rsGol);
	
	$rsjbt = RELASIJABATAN_load($kary['KODE_KARYAWAN']);
	$jbt = array();
	while ($jj = mysql_fetch_assoc($rsjbt)){
		$jbt[] = $jj;
	}
	$kary['JABATAN'] = $jbt;
	mysql_free_result($rsjbt);
	
	//status kerja
	$kary['STATUS_KERJA'] = mysql_fetch_assoc(detilStatusKaryawan_load($kary['KODE_KARYAWAN']));
	
	return $kary;
}
