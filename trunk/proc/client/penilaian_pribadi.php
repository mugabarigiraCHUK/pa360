<?php 
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/kriteriaPenilaian.php';
include_once '../../model/detilKriteriaPenilaian.php';
include_once '../../model/bobotLevel.php';
include_once '../../model/detilBobotLevel.php';
include_once '../../model/deskripsiBobot.php';
include_once '../../model/periode.php';
include_once '../../model/karyawan.php';
include_once '../../model/penilai.php';

$proc = $_REQUEST['proc'];

switch ($proc){
	case 0:	//jabatan combo
		$karyID = $_POST['karyID'];
		include '../../view/client/penilaian_pribadi/jabatanCombo.php';
		break;
	case 1:	//kriteria
		$karyID = $_POST['karyID'];
		$periodeID = $_POST['periodeID'];
		$levelID = $_POST['levelID'];
		include '../../view/client/penilaian_pribadi/kripen.php';
		break;
	case 2:
		$karyID = $_POST['karyID'];
		$periodeID = $_POST['periodeID'];
		$dep_div_jabID = $_POST['dep_div_jabID'];
		$levelID = $_POST['levelID'];
		$nilaiPerPenilaiID = $dinilaiID = $penilaiID = '';
		
		if ($karyID=="" || !$karyID || !isset($karyID)) return;
		
		//cek penilaiID, jika tidak ada tambahkan
		if (! penilai_isExist($karyID, $dep_div_jabID)){
			penilai_add($karyID, $dep_div_jabID);
		}
		$PENILAI = penilai_load($karyID, $dep_div_jabID);
		$PENILAI = mysql_fetch_assoc($PENILAI);
		$penilaiID = $PENILAI['KODE_PENILAI'];
		
		//cek nilaiAkhir, jika tidak ada tambahkan
		if (!nilaiAkhir_isExist($karyID, $dep_div_jabID, $periodeID)){
			nilaiAkhir_add($karyID, $dep_div_jabID, $periodeID, 0);
		}
		$NA = nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID);
		$NA = mysql_fetch_assoc($NA);
		$dinilaiID = $NA['KODE_DINILAI'];
		
		//echo 'kode penilai : '. $penilaiID .'<br>';
		//echo 'kode dinilai : '. $naID .'<br>';
		
		//cek nilaiPerPenilai
		$BOBOTLV = bobotlv_select(false, $periodeID, $levelID);
		$BOBOTLV = mysql_fetch_assoc($BOBOTLV);
		$bobotlvID = $BOBOTLV['ID_BOBOT_LEVEL']; 
		if (!npp_isExist($dinilaiID, $penilaiID, $bobotlvID)){
			npp_insert($dinilaiID, $penilaiID, $bobotlvID, 0);
		}
		$NPP = npp_load($dinilaiID, $penilaiID, $bobotlvID);
		$NPP = mysql_fetch_assoc($NPP);
		$nilaiPerPenilaiID = $NPP['ID_NILAI_PER_PENILAI'];
		
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
			$nilaiPerKriteria=0;
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
			
			/**
			 * UPDATE nilai NILAI_PER_KRITERIA
			 */
			//persiapan untuk NILAI_PER_PENILAI
			$nilaiPerPenilai += $nilaiPerKriteria * ($debotlv0['BOBOT']/100);
			//langsung update, krn sudah add diatas
			$ex &= npkrt_updateByID($npkrtID, false, false, $nilaiPerKriteria * ($debotlv0['BOBOT']/100));
		}
		
		/* save NILAI_PER_PENILAI */
		$ex &= npp_update($nilaiPerPenilaiID, $nilaiPerPenilai);
		
		/**
		 * save NILAI_AKHIR
		 */
		//select BOBOT_LEVEL -->> untuk lihat level penilaian
		$bobotlv0 = bobotlv_select(false, $periodeID);
		$bobotlvList = "";
		while ($row = mysql_fetch_assoc($bobotlv0)){
			$bobotlvList .= $bobotlvList==""? "" : ",";
			$bobotlvList .= $row['ID_BOBOT_LEVEL'];
		}
		mysql_free_result($bobotlv0);
			
		//kode dinilai
		$npp0 = mysql_fetch_assoc(npp_loadByID($nilaiPerPenilaiID));
		$dinilaiID = $npp0['KODE_DINILAI'];
		
		$levelNPP = array('HZ'=>0, 'VC'=>0);
		$nilaiAkhir = 0;
		$rsNPP = npp_select("ID_BOBOT_LEVEL IN ($bobotlvList) AND KODE_DINILAI='$dinilaiID'");
		//hitung per sub level (HZ1, HZ2 .... / VC1, VC2, ...)
		while ($ll = mysql_fetch_assoc($rsNPP)){
			//load bobot_level
			$rsBobotLv = bobotlv_loadByID($ll['ID_BOBOT_LEVEL']);
			$rsBobotLv = mysql_fetch_assoc($rsBobotLv);
			
			//vertikal / horizontal, hitung total sub level
			$KK = preg_match('/HZ/i', $rsBobotLv['ID_LEVEL'])? 'HZ' : 'VC';
			$levelNPP[$KK] += doubleval($ll['NILAI']) * (doubleval($rsBobotLv['BOBOT'])/100);
		}
		mysql_free_result($rsNPP);
		
		//hitung per level
		$rsPeriode = periode_load($periodeID);
		$rsPeriode = mysql_fetch_assoc($rsPeriode);
		foreach ($levelNPP as $key=>$value){
			$KK = preg_match('/HZ/i', $key)? 'BOBOT_HORIZONTAL' : 'BOBOT_VERTIKAL';
			$nilaiAkhir += $value * doubleval($rsPeriode[$KK])/100;
		}
		
		//jang simpan nilai akhir, karena ini untuk penilaian pribadi
//		$ex &= nilaiAkhir_update($dinilaiID, false, false, false, $nilaiAkhir);
		
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		break;
}