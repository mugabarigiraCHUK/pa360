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
			$TMP['ID_NILAI_PER_PENILAI'] = $nppList['ID_NILAI_PER_PENILAI'];
			//append result
			$RESULT[$key] = $TMP;
		}
	}
	mysql_free_result($NPP);
	return $RESULT;
}

function laporan_detail_kripen($karyID, $dep_div_jabID, $periodeID){
	//cari kode dinilai
	$NA = mysql_fetch_assoc( nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID) );	
	
	//load bobot level dengan perioded tertentu
	$BOBOTLV = bobotlv_select(false, $periodeID);
	$bobotlvList = "";
	while ($row = mysql_fetch_assoc($BOBOTLV)){
		$bobotlvList .= $bobotlvList==""? "" : ",";
		$bobotlvList .= "\"".$row['ID_BOBOT_LEVEL']."\"";
	}
	mysql_free_result($BOBOTLV);
	
	//load nilai_per_penilai dengan KODE_DINILAI dan list PERIODE tertentu
	$NPP = npp_select("ID_BOBOT_LEVEL IN ($bobotlvList) AND KODE_DINILAI='".$NA['KODE_DINILAI']."'");
	$nppList = ""; 
	while ($row = mysql_fetch_assoc($NPP)){
		$nppList .= $nppList==""? "" : ",";
		$nppList .= "\"".$row['ID_NILAI_PER_PENILAI']."\"";
	}
	mysql_free_result($NPP);
	
	//load nilai_per_kriteria dengan ID_NILAI_PER_PENILAI tertentu
	$NPKRT = npkrt_select2("ID_NILAI_PER_PENILAI IN ($nppList)");
	
	$RESULT =array();
	while ($row = mysql_fetch_assoc($NPKRT)){
		//load detil_bobot_level
		$DEBOTLV = mysql_fetch_assoc( debotlv_loadByID($row['ID_DETIL_BOBOT_LEVEL']) );
		
		//load bobot_level
		$BOBOTLV = mysql_fetch_assoc( bobotlv_loadByID($DEBOTLV['ID_BOBOT_LEVEL']) );
		
		//load kriteria_penilaian
		$KRIPEN = mysql_fetch_assoc( kripen_load($DEBOTLV['ID_KRITERIA']) );
		
		//sampe sini semua data sudah siap
		$TMP = array();
		$TMP['NAMA_KRITERIA'] = $KRIPEN['NAMA_KRITERIA'];
		$TMP['BOBOT_KRITERIA'] = $DEBOTLV['BOBOT'];
		$TMP[$BOBOTLV['ID_LEVEL']] = $row['NILAI'];
		$TMP['ID_NILAI_PER_KRITERIA'] = $row['ID_NILAI_PER_KRITERIA'];
		$RESULT[$KRIPEN['ID_KRITERIA']] = $TMP;
	}
	mysql_free_result($NPKRT);
	
	return $RESULT;
}

function laporan_detail_dekripen($npkrtID){
	$RESULT=array();
	
	$NPK = npk_select2("ID_NILAI_PER_KRITERIA=$npkrtID");
	while ($row = mysql_fetch_assoc($NPK) ){
		
	}
	return $RESULT;
}
