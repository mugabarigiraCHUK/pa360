<?php
function laporan_global($periodeID, $departemenID=false){
	//bikin key
	$KEY = array();
	$BBTLV = bobotlv_select(false, $periodeID);
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] =0;
	}
	mysql_free_result($BBTLV);
	
	//load bobot level dengan perioded tertentu
	$BOBOTLV = bobotlv_select(false, $periodeID);
	$bobotlvList = "";
	while ($row = mysql_fetch_assoc($BOBOTLV)){
		$bobotlvList .= $bobotlvList==""? "" : ",";
		$bobotlvList .= "\"".$row['ID_BOBOT_LEVEL']."\"";
	}
	
	//cari datanya
	$RESULT = array();
	$NPP = npp_select("ID_BOBOT_LEVEL IN ($bobotlvList)");
	$RESULT = array();
	while ($row = mysql_fetch_assoc($NPP)){
		//load table nilai_akhir
		$NA = mysql_fetch_assoc( nilaiAkhir_loadByID($row['KODE_DINILAI']) );
		
		//cek in array. given key
		$key = $row['KODE_DINILAI'] ."-". $NA['ID_DEP_DIV_JAB'];
		if (array_key_exists($key, $RESULT)) continue;
		
		//load table data_karyawan
		$KARY = mysql_fetch_assoc( kary_load($NA['KODE_KARYAWAN']) );
		
		//load table dep_div_jab
		$DEPDIVJAB = mysql_fetch_assoc( RELASIJABATAN_load($NA['KODE_KARYAWAN'], $NA['ID_DEP_DIV_JAB']) );
	
		//load table nilai_per_penilai with given KODE_DINILAI
		$NPP2 = npp_select("ID_BOBOT_LEVEL IN ($bobotlvList) AND KODE_DINILAI='".$row['KODE_DINILAI']."'");
		$nppList = array();
		while ($list = mysql_fetch_assoc($NPP2)){
			$BOBOTLV = mysql_fetch_assoc( bobotlv_select($list['ID_BOBOT_LEVEL']) );
			$nppList[$BOBOTLV['ID_LEVEL']] = $list['NILAI'];
		}
		
		//check departement
		if ($DEPDIVJAB['ID_DEPARTMENT']==$departemenID || !$departemenID){
			$TMP = array();
			$TMP = $NA;
			$TMP['KODE_DINILAI'] = $row['KODE_DINILAI'];
			$TMP['KODE_KARYAWAN'] = $NA['KODE_KARYAWAN'];
			$TMP['NAMA_KARYAWAN'] = $KARY['NAMA_KARYAWAN'];
			$TMP['JABATAN'] = $DEPDIVJAB;
			$TMP['ID_NILAI_PER_PENILAI'] = $row['ID_NILAI_PER_PENILAI'];
			$TMP['LEVEL'] = $nppList;
			//append result
			$RESULT[$key] = $TMP;
		}
	}
	mysql_free_result($NPP);
	return $RESULT;
}

function laporan_detail_kripen($karyID, $dep_div_jabID, $periodeID){
	$NA = mysql_fetch_assoc( nilaiAkhir_select(false, $karyID, $dep_div_jabID, $periodeID) );
	$dinilaiID = $NA['KODE_DINILAI']; 
			
	$BOBOTLV = bobotlv_select(false, $periodeID);
	while ($row = mysql_fetch_assoc($BOBOTLV)){
		
		//load nilai_per_penilai, untuk ambil ID_NILAI_PERPENILAI pada $row['ID_LEVEL']
		$NPP = mysql_fetch_assoc( npp_select("KODE_DINILAI='$dinilaiID' AND ID_BOBOT_LEVEL='".$row['ID_BOBOT_LEVEL']."'") );
		
		//load detail_bobot_level, untuk ambil nilai bobot dan kriteria pada $row['ID_LEVEL']
		$DEBOTLV = debotlv_select(false, $row['ID_BOBOT_LEVEL']);

		$TMP = array();
		while ($row2 = mysql_fetch_assoc($DEBOTLV)){
			$TMP_KRIPEN = array();
			
			//append bobot
			$TMP_KRIPEN['BOBOT'] = $row2['BOBOT'];
			
			//load kriteria, untuk level $row['ID_LEVEL'] ambil nama kriteria
			$KRIPEN = mysql_fetch_assoc( kripen_load($row2['ID_KRITERIA']) );
			
			//append kripen data
			$TMP_KRIPEN['ID_KRITERIA'] = $KRIPEN['ID_KRITERIA'];
			$TMP_KRIPEN['NAMA_KRITERIA'] = $KRIPEN['NAMA_KRITERIA'];
			$TMP_KRIPEN['DESKRIPSI'] = $KRIPEN['DESKRIPSI'];
			
			//load nilai_per_kriteria
			//-- BUG --
			$NPKRT = mysql_fetch_assoc( npkrt_select(false, 
													!$NPP['ID_NILAI_PER_PENILAI']? "-" : $NPP['ID_NILAI_PER_PENILAI'], 
													!$row2['ID_DETIL_BOBOT_LEVEL']? "-" : $row2['ID_DETIL_BOBOT_LEVEL']) );

			//append nilai
			$TMP_KRIPEN['NILAI'] = $NPKRT['NILAI'];
			
			//append detail_kriteria
			$TMP_KRIPEN['DEKRIPEN'] = laporan_detail_dekripen($KRIPEN['ID_KRITERIA'], $NPKRT['ID_NILAI_PER_KRITERIA']); 
			
			$TMP[$KRIPEN['ID_KRITERIA']] = $TMP_KRIPEN;
		}
		
		$RESULT[$row['ID_LEVEL']]['KRITERIA'] = $TMP;
		$RESULT[$row['ID_LEVEL']]['NILAI_LEVEL'] = $NPP['NILAI'];
		$RESULT[$row['ID_LEVEL']]['BOBOT_LEVEL'] = $row['BOBOT'];
		
		//append penilai
		$PENILAI = mysql_fetch_assoc( penilai_loadByID($NPP['ID_PENILAI']) );
		$KARY = mysql_fetch_assoc(kary_load($PENILAI['KODE_KARYAWAN']));
		$RESULT[$row['ID_LEVEL']]['PENILAI'] = $KARY['NAMA_KARYAWAN'];
	}
	return $RESULT;
}

function laporan_detail_dekripen($kripenID, $npkrtID){
//	if (!$kripenID || $kripenID=="") return array();

	//--- BUG --- 
	//$npkrtID="" ==> dibaca false
	if (!$npkrtID || $npkrtID=="") $npkrtID='-';
	
	$RESULT=array();
	$dekripen = dekripen_select($kripenID);
	while($row = mysql_fetch_assoc($dekripen)){
		$TMP = array();
		$TMP['NAMA_DETAIL_KRITERIA'] = $row['NAMA_DETAIL_KRITERIA'];
		$TMP['DESKRIPSI'] = $row['DESKRIPSI'];
		$TMP['BOBOT'] = $row['BOBOT'];
		
		//load nilai
		$NPK = mysql_fetch_assoc( npk_select(false, $row['ID_DETAIL_KRITERIA'], $npkrtID) );
		$TMP['NILAI'] = $NPK['NILAI'];

		//append result
		$RESULT[] = $TMP;
	}
	
	return $RESULT;
}
