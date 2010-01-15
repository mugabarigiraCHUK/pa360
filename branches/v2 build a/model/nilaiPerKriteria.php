<?php
function npkrt_add($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
				$kripenID, $levelID, $nilai){
	$sql = "INSERT INTO nilai_per_kriteria  
			VALUES('$karyID','$penilaiID','$periodeID','$dep_div_jabID','$kripenID','$levelID',$nilai)";
	return mysql_query($sql);
}

function npkrt_update($karyID, $penilaiID, $periodeID, $dep_div_jabID, 
						$kripenID, $levelID, $nilai){
	$sql = "UPDATE nilai_per_kriteria
				set NILAI = $nilai
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'	AND 
				ID_KRITERIA='$kripenID'";
	return mysql_query($sql);
}

function npkrt_delete($karyID, $penilaiID, $periodeID, $dep_div_jabID, $levelID, $kripenID=false){
	$sql = "DELETE FROM nilai_per_kriteria 
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'";
	if ($kripenID){
		$sql .= " AND ID_KRITERIA='$kripenID'";
	}
	return mysql_query($sql);
}

function npkrt_exist($karyID, $penilaiID, $periodeID, $dep_div_jabID, $kripenID, $levelID){
	$sql = "SELECT * FROM nilai_per_kriteria 
			WHERE KODE_KARYAWAN='$karyID' AND  
				PENILAI='$penilaiID' AND 
				ID_PERIODE='$periodeID' AND  
				ID_DEP_DIV_JAB='$dep_div_jabID' AND 
				ID_LEVEL='$levelID'	AND 
				ID_KRITERIA='$kripenID'";
	$rs = mysql_query($sql);
	while ($row = mysql_fetch_assoc($rs)){
		return true;
	}
	return false;
}

function npkrt_select($karyID=false, $penilaiID=false, $periodeID=false, $dep_div_jabID=false, 
					$kripenID=false, $levelID=false){
	$sql = "SELECT * FROM nilai_per_kriteria ";
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
	if ($kripenID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_KRITERIA='$kripenID' "; 
	}
	$sql .= " WHERE ". $sqlw;
	return mysql_query($sql); 
}