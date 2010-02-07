<?php
function nilaiAkhir_select($id=false, $karyID=false, $dep_div_jabID=false, $periodeID=false){
	$sql = "SELECT * FROM nilai_akhir ";
	$sqlw = false;
	
	if ($id){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "KODE_DINILAI='$id'";
	}
	if ($karyID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "KODE_KARYAWAN='$karyID'";
	}
	if ($periodeID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "ID_PERIODE='$periodeID'";
	}
	if ($dep_div_jabID){
		$sqlw .= $sqlw? " AND " : "";
		$sqlw .= "ID_DEP_DIV_JAB='$dep_div_jabID'";
	}		
	$sql .= $sqlw? " WHERE ".$sqlw : ""; 
	return mysql_query($sql);
}

function nilaiAkhir_select0($where, $orderby=false, $groupby=false){
	$sql = "SELECT * FROM nilai_akhir";
	$sql .= $where? " WHERE ".$where : "";
	$sql .= $orderby? " ORDER BY ".$orderby : "";
	$sql .= $groupby? " GROUP BY ".$groupby : "";
	
	return mysql_query($sql);
}

function nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID){
	return nilaiAkhir_select(false, $karyID, $dep_div_jabID, $periodeID);
}

function nilaiAkhir_loadByID($id){
	return nilaiAkhir_select($id);
}

function nilaiAkhir_isExist($karyID, $dep_div_jabID, $periodeID){
	$sql = nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID);
	while ($row = mysql_fetch_assoc($sql)){ return true; }
	return false;
}

function nilaiAkhir_isExistID($id){
	$sql = nilaiAkhir_loadByID($id);
	while ($row = mysql_fetch_assoc($sql)){ return true; }
	return false;
}

function nilaiAkhir_add($karyID, $dep_div_jabID, $periodeID, $nilai){
	$nilai = doubleval($nilai);
	$sql = "INSERT INTO nilai_akhir (KODE_KARYAWAN, ID_DEP_DIV_JAB, ID_PERIODE, NILAI_AKHIR)
			VALUES ('$karyID', '$dep_div_jabID', '$periodeID', '$nilai')";
	return mysql_query($sql);
}

function nilaiAkhir_delete($id){
	$sql = "DELETE FROM nilai_akhir WHERE KODE_DINILAI='$id'";
	return mysql_query($sql);
}

function nilaiAkhir_update($dinilaiID, $karyID=false, $dep_div_jab_ID=false, $periodeID=false, $nilaiAkhir=false){
	$nilai = doubleval($nilai);
	
	//set
	$sql = "UPDATE nilai_akhir";
	if ($karyID){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "KODE_KARYAWAN='$karyID'";
	}
	if ($dep_div_jab_ID){
		$sqls .= $sqls==""? "" : ",";		
		$sqls .= "ID_DEP_DIV_JAB='$dep_div_jabID'";
	}
	if ($periodeID){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "ID_PERIODE='$periodeID'";
	}
	if ($nilaiAkhir || is_numeric($nilaiAkhir)){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "NILAI_AKHIR=$nilaiAkhir"; 
	}
	$sqls = $sqls==""? "" : " SET ".$sqls;
	
	//where
	$sqlw = " WHERE KODE_DINILAI='$dinilaiID'"; 
	return mysql_query($sql.$sqls.$sqlw);
}

function nilaiAkhir_count($periodeID, $departemenID=false, $threshold=false){
	$sql = "select count(NILAI_AKHIR) as COUNT 
			FROM 
				nilai_akhir as a,
				relasi_div_jab_din as b,
				dep_divisi_jabatan as c
			WHERE 
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB 
				AND b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				AND a.ID_PERIODE='$periodeID'";
	
	if ($departemenID){
		$sql .= " AND c.ID_DEPARTMENT='$departemenID'";
	}
	if ($threshold){
		$sql .= " AND $threshold";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['COUNT']==NULL || $res['COUNT']===''? 0 : $res['COUNT'];
}

function nilaiAkhir_avg($periodeID, $departemenID=false){  
	$sql = "SELECT avg(NILAI_AKHIR) as AVG 
			FROM 
				nilai_akhir as a,
				relasi_div_jab_din as b,
				dep_divisi_jabatan as c
			WHERE 
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB 
				AND b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				AND a.ID_PERIODE='$periodeID'";
	
	if ($departemenID){
		$sql .= " AND c.id_department='$departemenID'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['AVG']==NULL || $res['AVG']===''? 0 : $res['AVG'];
}

function nilaiAkhir_max($periodeID, $departemenID=false){  
	$sql = "select max(NILAI_AKHIR) as MAX 
			FROM 
				nilai_akhir as a,
				relasi_div_jab_din as b,
				dep_divisi_jabatan as c
			WHERE 
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB 
				AND b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				AND a.ID_PERIODE='$periodeID'";
	
	if ($departemenID){
		$sql .= " AND c.ID_DEPARTMENT='$departemenID'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['MAX']==NULL || $res['MAX']===''? 0 : $res['MAX'];
}

function nilaiAkhir_min($periodeID, $departemenID=false){  
	$sql = "SELECT min(NILAI_AKHIR) as MIN 
			FROM 
				nilai_akhir as a,
				relasi_div_jab_din as b,
				dep_divisi_jabatan as c
			WHERE 
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB 
				AND b.ID_DEP_DIV_JAB = c.ID_DEP_DIV_JAB
				AND a.ID_PERIODE='$periodeID'";
	
	if ($departemenID){
		$sql .= " AND c.ID_DEPARTMENT='$departemenID'";
	}
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['MIN']==NULL || $res['MIN']===''? 0 : $res['MIN'];
}