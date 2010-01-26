<?php
function debotlv_select($id=false, $bobotlvID=false, $periodeID=false, $levelID=false, $kripenID=false){
	$sql="SELECT a.ID_DETIL_BOBOT_LEVEL,
			a.ID_KRITERIA,
			b.NAMA_KRITERIA,
			b.DESKRIPSI,
			a.ID_BOBOT_LEVEL,
			c.ID_PERIODE,
			c.ID_LEVEL,
			c.NAMA_LEVEL,
			c.DESKRIPSI,
			c.BOBOT as BOBOT_LEVEL,
			a.BOBOT
		FROM detil_bobot_level as a, 
			kriteria_penilaian as b, 
			bobot_level as c
		WHERE a.ID_KRITERIA=b.ID_KRITERIA AND a.ID_BOBOT_LEVEL=c.ID_BOBOT_LEVEL ";
	
	if ($id){	
		$sql .= " AND a.ID_DETIL_BOBOT_LEVEL='$id'";
	}
	if ($bobotlvID){
		$sql .= " AND a.ID_BOBOT_LEVEL='$bobotlvID'";
	}
	if ($periodeID){
		$sql .= " AND c.ID_PERIODE='$periodeID'";
	}
	if ($levelID){
		$sql .= " AND c.ID_LEVEL='$levelID'";
	}
	if ($kripenID){
		$sql .= " AND a.ID_KRITERIA='$kripenID'";
	}
	return mysql_query($sql);
}

function debotlv_loadByID($id){
	return debotlv_select($id);	
}

function debotlv_load($periodeID, $levelID, $kripenID){
	return debotlv_select(false, $periodeID, $levelID, $kripenID);
}

function debotlv_sumBobot($periodeID, $levelID, $excludeDebotlvID=false){
	$sql ="SELECT SUM(a.BOBOT) AS SUM
		FROM detil_bobot_level as a, 
			kriteria_penilaian as b, 
			bobot_level as c
		WHERE a.ID_KRITERIA=b.ID_KRITERIA AND a.ID_BOBOT_LEVEL=c.ID_BOBOT_LEVEL 
			AND c.ID_PERIODE='$periodeID'
			AND c.ID_LEVEL='$levelID'";
	
	if ($excludeDebotlvID){
		$sql .= " AND a.ID_DETIL_BOBOT_LEVEL!='$excludeDebotlvID'";
	}
	
	$res= mysql_fetch_assoc( mysql_query($sql) );
	return $res['SUM'];
}

function debotlv_add($kripenID, $bobolvID, $bobot){
	$sql = "INSERT INTO detil_bobot_level (ID_KRITERIA, ID_BOBOT_LEVEL, BOBOT)
			VALUES('$kripenID', '$bobolvID', $bobot)";
	return mysql_query($sql);
}

function debotlv_update($debotlvID, $kripenID, $bobolvID, $bobot){
	$sql = "UPDATE detil_bobot_level 
			SET ID_KRITERIA='$kripenID', 
				ID_BOBOT_LEVEL='$bobolvID', 
				BOBOT=$bobot
			WHERE ID_DETIL_BOBOT_LEVEL='$debotlvID'";
	return mysql_query($sql);
}

function debotlv_delete($debotlvID){
	$sql = "DELETE FROM detil_bobot_level WHERE ID_DETIL_BOBOT_LEVEL=$debotlvID";
	return mysql_query($sql);
}