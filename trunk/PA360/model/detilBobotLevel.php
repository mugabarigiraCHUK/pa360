<?php

function debotlv_select($periodeID, $levelID){
	$sql = "SELECT 
				a.ID_KRITERIA, b.NAMA_KRITERIA, b.DESKRIPSI, b.BOBOT  
			FROM 
				detil_bobot_level as a,
				kriteria_penilaian as b
			WHERE 
				a.ID_KRITERIA = b.ID_KRITERIA AND
				a.ID_PERIODE = '$periodeID' AND 
				a.ID_LEVEL = '$levelID'";
	return mysql_query($sql);	
}

function debotlv_load($periodeID, $levelID, $kripenID){
	$sql = "SELECT 
				a.ID_KRITERIA, b.NAMA_KRITERIA, b.DESKRIPSI, b.BOBOT  
			FROM 
				detil_bobot_level as a,
				kriteria_penilaian as b
			WHERE 
				a.ID_KRITERIA = b.ID_KRITERIA AND
				a.ID_PERIODE = '$periodeID' AND 
				a.ID_LEVEL = '$levelID' AND
				a.ID_KRITERIA = '$kripenID'";
	return mysql_query($sql);	
}

function debotlv_countBobot($periodeID, $levelID){
	$result = debotlv_select($periodeID,$levelID);
	while ($row = mysql_fetch_assoc($result)){
		$bobot += $row['BOBOT'];
	}
	return $bobot;
}

function debotlv_add($periodeID, $levelID, $kripenID){
	$sql = "INSERT INTO detil_bobot_level VALUES(
			'$periodeID', '$levelID', '$kripenID')";
	return mysql_query($sql);
}

function debotlv_delete($periodeID, $levelID, $kripenID){
	$sql = "DELETE FROM detil_bobot_level 
			WHERE ID_PERIODE = '$periodeID' AND
			ID_LEVEL =  '$levelID' AND 
			ID_KRITERIA = '$kripenID'";
	return mysql_query($sql);
}