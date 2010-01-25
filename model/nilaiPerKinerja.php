<?php

function npk_add($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
				$dekripenID, $levelID, $nilai){
	$sql = "INSERT INTO nilai_per_kinerja 
			VALUES('$karyID','$penilaiID','$periodeID','$dep_div_jabID','$dekripenID','$levelID',$nilai)";
	return mysql_query($sql);
}

function npk_update($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
				$dekripenID, $levelID, $nilai){
	$sql = "UPDATE nilai_per_kinerja
				set NILAI = $nilai
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'	AND 
				ID_DETAIL_KRITERIA='$dekripenID'";
	return mysql_query($sql);
}

function npk_delete($karyID, $penilaiID, $periodeID, $dep_div_jabID, $levelID, $dekripenID=false){
	$sql = "DELETE FROM nilai_per_kinerja 
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'";
	if ($dekripenID){
		$sql .= " AND ID_DETAIL_KRITERIA='$dekripenID'";
	}
	return mysql_query($sql);
}

function npk_exist($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
				$dekripenID, $levelID){
	$sql = "SELECT * FROM nilai_per_kinerja 
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'	AND 
				ID_DETAIL_KRITERIA='$dekripenID'";
	$rs = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rs)){
		return true;
	}
	return false;
}

function npk_select($karyID=false, $penilaiID=false, $periodeID=false, $dep_div_jabID=false, 
					$dekripenID=false, $levelID=false){
	$sql = "SELECT * FROM nilai_per_kinerja ";
	$sqlw = "";
	if ($karyID){
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " KODE_KARYAWAN='$karyID' "; 
	}
	if ($penilaiID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " PENILAI='$penilaiID' "; 
	}
	if ($periodeID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= "ID_PERIODE='$periodeID' "; 
	}
	if ($dep_div_jabID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_DEP_DIV_JAB='$dep_div_jabID' "; 
	}
	if ($levelID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_LEVEL='$levelID' "; 
	}
	if ($dekripenID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_DETAIL_KRITERIA='$dekripenID' "; 
	}
	$sql .= " WHERE ". $sqlw;
	return mysql_query($sql); 
}