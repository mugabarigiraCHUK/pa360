<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../model/kriteriaPenilaian.php';
include_once '../../model/detilKriteriaPenilaian.php';
include_once '../../model/nilaiPerKinerja.php';
include_once '../../model/nilaiPerKriteria.php';
include_once '../../model/nilaiPerPenilai.php';
include_once '../../model/nilaiAkhir.php';
include_once '../../model/bobotLevel.php';
include_once '../../model/detilBobotLevel.php';
include_once '../../model/periode.php';

$proc = $_REQUEST['proc'];

if ($proc === 'detilPenilaian-save'){
	$karyID = $_POST['karyID']; 
	$penilaiID = $_POST['penilaiID'];
	$periodeID = $_POST['periodeID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$levelID = $_POST['levelID'];
	$nilaiPerPenilaiID = $_POST['nilaiPerPenilaiID'];
	
	/**
	 * bentuk array dekripen
	 * [dekripen] => Array (
	 * 		[ <kriteria ID> ] => Array (
	 * 			[ <detail kriteria ID> ] => [nilai]
	 *      )
	 * ) 
	 */
	$dekripen = $_POST['dekripen'];
	
	$ex=true;
	
	//insert ke table NILAI_PER_KINERJA dan NILAI_PER_KRITERIA
	foreach ($dekripen as $kriteriaKey=>$kriteriaVal){			//<kriteria ID>
		$nilaiPerKriteria=0;
		
		/* cari ID bobot level */
		$debotlv0 = mysql_fetch_assoc(debotlv_select(false, false, $periodeID, $levelID, $kriteriaKey));  
		$debotlvID = $debotlv0['ID_DETIL_BOBOT_LEVEL'];
		$debotlvID = $debotlvID==""||!isset($debotlvID)? false : $debotlvID;
		
		/* cari ID nilai_per_kriteria */
		if (! npkrt_exist(false, $nilaiPerPenilaiID, $debotlvID)){
			npkrt_add($nilaiPerPenilaiID, $debotlvID, 0.0);
		}
		$npkrtID = npkrt_getID($nilaiPerPenilaiID, $debotlvID);
		
		/**
		 * save NILAI_PER_KINERJA
		 */
		foreach($kriteriaVal as $detilKrtKey=>$detilKrtVal){	//<detail kriteria ID>		
			//cari bobot detail kriteria
			$rsDekripen0 = dekripen_load($detilKrtKey);
			$rsDekripen = mysql_fetch_assoc($rsDekripen0);
			
			//hitung nilaiPerKinerja
			$nilai = $detilKrtVal * ($rsDekripen['BOBOT'] / 100);
			
			//save NILAI_PER_KINERJA,
			if (npk_exist(false, $detilKrtKey, $npkrtID)){
				$npkID = npk_getID($detilKrtKey, $npkrtID);
				$ex &= npk_update($npkID, $detilKrtKey, $npkrtID, $nilai);
			}
			else{
				$ex &= npk_add('', $detilKrtKey, $npkrtID, $nilai);
			}
					
			//sum NILAI_PER_KRITERIA
			$nilaiPerKriteria += $nilai;
			mysql_free_result($rsDekripen0);
		}
		
//		/**
//		 * UPDATE nilai NILAI_PER_KRITERIA
//		 */
//		//load KRITERIA_PENILAIAN
//		$rsKripen0 = kripen_load($kriteriaKey);
//		$rsKripen = mysql_fetch_assoc($rsKripen0);
//		
//		//persiapan untuk NILAI_PER_PENILAI
//		$nilaiPerPenilai += $nilaiPerKriteria * ($rsKripen['BOBOT']/100);
//		
//		//save
//		if (npkrt_exist($karyID, $penilaiID, $periodeID, $dep_div_jabID, $kriteriaKey, $levelID)){
//			$ex &= npkrt_update($karyID, $penilaiID, $periodeID, $dep_div_jabID, $kriteriaKey, $levelID, $nilaiPerKriteria);
//		}else{
//			$ex &= npkrt_add($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
//						$kriteriaKey, $levelID, $nilaiPerKriteria);
//		}
	}
	
//	/**
//	 * save NILAI_PER_PENILAI
//	 */
//	$ex &= npp_update($nilaiPerPenilaiID, $nilaiPerPenilai);
//	
//	/**
//	 * save NILAI_AKHIR
//	 */
//	$levelNPP = array('HZ'=>0, 'VC'=>0);
//	$nilaiAkhir = 0;
//	$rsNPP = npp_select("KODE_KARYAWAN='$karyID' AND 
//						ID_PERIODE='$periodeID' AND 
//						ID_DEP_DIV_JAB='$dep_div_jabID'");
//	//hitung per sub level (HZ1, HZ2 .... / VC1, VC2, ...)
//	while ($ll = mysql_fetch_assoc($rsNPP)){
//		//load bobot_level
//		$rsBobotLv = bobotlv_load($periodeID, $ll['ID_LEVEL']);
//		$rsBobotLv = mysql_fetch_assoc($rsBobotLv);
//		
//		//vertikal / horizontal, hitung total sub level
//		$KK = preg_match('/HZ/i', $ll['ID_LEVEL'])? 'HZ' : 'VC';
//		$levelNPP[$KK] += doubleval($ll['NILAI']) * (doubleval($rsBobotLv['BOBOT'])/100);
//	}
//	mysql_free_result($rsNPP);
//	
//	//hitung per level
//	$rsPeriode = periode_load($periodeID);
//	$rsPeriode = mysql_fetch_assoc($rsPeriode);
//	foreach ($levelNPP as $key=>$value){
//		$KK = preg_match('/HZ/i', $key)? 'BOBOT_HORIZONTAL' : 'BOBOT_VERTIKAL';
//		$nilaiAkhir += $value * doubleval($rsPeriode[$KK])/100;
//	}
//	
//	//save
//	if (nilaiAkhir_isExist($karyID, $periodeID, $dep_div_jabID)){	//update
//		$ex &= nilaiAkhir_update($karyID, $periodeID, $dep_div_jabID, $nilaiAkhir);
//	}
//	else{	//insert
//		$ex &= nilaiAkhir_add($karyID, $periodeID, $dep_div_jabID, $nilaiAkhir);
//	}
	
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}