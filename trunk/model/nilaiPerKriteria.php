<?php
function npkrt_add($nppID=false, $debotlvID=false, $nilai=false){
	$sql = "INSERT INTO nilai_per_kriteria(ID_NILAI_PER_PENILAI, ID_DETIL_BOBOT_LEVEL, NILAI) 
			VALUES('$nppID', '$debotlvID', $nilai)";
	return mysql_query($sql);
}

function npkrt_getID($nppID=false, $debotlvID=false){
	$rs = npkrt_select($npkrtID, $nppID, $debotlvID);
	while ($row = mysql_fetch_assoc($rs)){
		return $row['ID_NILAI_PER_KRITERIA'];
	}
	return false;
}

function npkrt_update(){
	
}

function npkrt_delete(){
}

function npkrt_exist($npkrtID=false, $nppID=false, $debotlvID=false){
	$rs = npkrt_select($npkrtID, $nppID, $debotlvID);
	while ($row = mysql_fetch_assoc($rs)){
		return true;
	}
	return false;
}

function npkrt_select($npkrtID=false, $nppID=false, $debotlvID=false){
	$sql = "SELECT * FROM nilai_per_kriteria ";
	$sqlw = "";
	if ($npkrtID){
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_NILAI_PER_KRITERIA='$npkrtID' "; 
	}
	if ($nppID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_NILAI_PER_PENILAI='$nppID' "; 
	}
	if ($debotlvID){ 
		$sqlw .= $sqlw===""? "" : " AND ";
		$sqlw .= " ID_DETIL_BOBOT_LEVEL='$debotlvID' "; 
	}
	$sql .= " WHERE ". $sqlw;
	return mysql_query($sql);
}