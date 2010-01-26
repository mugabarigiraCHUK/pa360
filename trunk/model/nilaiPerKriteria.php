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

function npkrt_updateByID($npkrtID, $nppID=false, $debotlvID=false, $nilai=false){
	$sql = "UPDATE nilai_per_kriteria ";
	
	//set
	if ($nppID){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "ID_NILAI_PER_PENILAI='$nppID'"; 
	}
	if ($debotlvID){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "ID_DETIL_BOBOT_LEVEL='$debotlvID'"; 
	}
	if ($nilai || is_numeric($nilai)){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "NILAI='$nilai'"; 
	}
	$sqls = $sqls==""? "" : " SET ".$sqls;
	
	//where
	$sqlw = " WHERE ID_NILAI_PER_KRITERIA='$npkrtID'";
	
	return mysql_query($sql.$sqls.$sqlw);
}

function npkrt_update($npkrtID, $nppID=false, $debotlvID=false, $nilai=0){
	$sql = "UPDATE nilai_per_kriteria SET NILAI=$nilai";
	if ($npkrtID){
		$sqlw = $sqlw==""? "" : " AND ID_NILAI_PER_KRITERIA='$npkrtID'"; 
	}
	if ($nppID){
		$sqlw = $sqlw==""? "" : " AND ID_NILAI_PER_PENILAI='$nppID'"; 
	}
	if ($debotlvID){
		$sqlw = $sqlw==""? "" : " AND ID_DETIL_BOBOT_LEVEL='$debotlvID'"; 
	}
	
	$sqlw = $sqlw==""? "" : " WHERE ".$sqlw;
	return mysql_query($sql.$sqlw);
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

function npkrt_select2($where=false, $orderBy=false){
	$sql = "SELECT * FROM nilai_per_kriteria ";
	if ($where){
		$sql .= " WHERE ". $where;
	}
	if ($orderBy){
		$sql .= " ORDER BY ". $orderBy;
	}
	return mysql_query($sql);
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
	$sqlw = " WHERE ". $sqlw;
	return mysql_query($sql.$sqlw);
}