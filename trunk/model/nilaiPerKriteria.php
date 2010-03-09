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
	$sql .= " WHERE ID_NILAI_PER_PENILAI NOT IN (
					SELECT ID_NILAI_PER_PENILAI 
					FROM nilai_per_penilai as a, nilai_akhir as b, penilai as c
					WHERE a.KODE_DINILAI = b.KODE_DINILAI AND
						a.KODE_PENILAI = c.KODE_PENILAI AND
						b.KODE_KARYAWAN = c.KODE_KARYAWAN AND 
						b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				)";
	if ($where){
		$sql .= " AND $where";
	}
	if ($orderBy){
		$sql .= " ORDER BY ". $orderBy;
	}
	return mysql_query($sql);
}

function npkrt_select($npkrtID=false, $nppID=false, $debotlvID=false){
	$sql = "SELECT * FROM nilai_per_kriteria ";
	$sqlw = " WHERE ID_NILAI_PER_PENILAI NOT IN (
					SELECT ID_NILAI_PER_PENILAI 
					FROM nilai_per_penilai as a, nilai_akhir as b, penilai as c
					WHERE a.KODE_DINILAI = b.KODE_DINILAI AND
						a.KODE_PENILAI = c.KODE_PENILAI AND
						b.KODE_KARYAWAN = c.KODE_KARYAWAN AND 
						b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				)";
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
	return mysql_query($sql.$sqlw);
}

function npkrt_debotlvIsExist($debotlvID){
	$res = npkrt_select(false, false, $debotlvID);
	while ($res = mysql_fetch_assoc($res)) { return true; }
	return false;
}

function npkrt_avg($debotlvID){
	$sql = "SELECT AVG(NILAI) as AVG 
			FROM nilai_per_kriteria
			WHERE ID_DETIL_BOBOT_LEVEL='$debotlvID' 
				AND ID_NILAI_PER_PENILAI NOT IN (
					SELECT ID_NILAI_PER_PENILAI 
					FROM nilai_per_penilai as a, nilai_akhir as b, penilai as c
					WHERE a.KODE_DINILAI = b.KODE_DINILAI AND
						a.KODE_PENILAI = c.KODE_PENILAI AND
						b.KODE_KARYAWAN = c.KODE_KARYAWAN AND 
						b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				)";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}

function npkrt_min($debotlvID){
	$sql = "SELECT MIN(NILAI) as MIN
			FROM nilai_per_kriteria
			WHERE ID_DETIL_BOBOT_LEVEL='$debotlvID'
				AND ID_NILAI_PER_PENILAI NOT IN (
					SELECT ID_NILAI_PER_PENILAI 
					FROM nilai_per_penilai as a, nilai_akhir as b, penilai as c
					WHERE a.KODE_DINILAI = b.KODE_DINILAI AND
						a.KODE_PENILAI = c.KODE_PENILAI AND
						b.KODE_KARYAWAN = c.KODE_KARYAWAN AND 
						b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				)";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['MIN']==NULL || $res['MIN']===''? 0 : $res['MIN'];
}

function npkrt_max($debotlvID){
	$sql = "SELECT MAX(NILAI) as MAX
			FROM nilai_per_kriteria
			WHERE ID_DETIL_BOBOT_LEVEL='$debotlvID' 
				AND ID_NILAI_PER_PENILAI NOT IN (
					SELECT ID_NILAI_PER_PENILAI 
					FROM nilai_per_penilai as a, nilai_akhir as b, penilai as c
					WHERE a.KODE_DINILAI = b.KODE_DINILAI AND
						a.KODE_PENILAI = c.KODE_PENILAI AND
						b.KODE_KARYAWAN = c.KODE_KARYAWAN AND 
						b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				)";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['MAX']==NULL || $res['MAX']===''? 0 : $res['MAX'];
}
