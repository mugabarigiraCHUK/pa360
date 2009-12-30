<?php

$_BOBOT_LEVEL_KEY = array(
	"HORIZONTAL" => "HZ",
	"VERTICAL" => "VC"
);

/**
 * 
 * @param $periodeID
 */
function bobotlv_select($periodeID){
	$sql = "SELECT *
			FROM bobot_level
			WHERE ID_PERIODE='$periodeID'
			ORDER BY ID_PERIODE ASC ";
	return mysql_query($sql);
}

/**
 * 
 * @param $periodeID
 * @param $level (string) - level id
 */
function bobotlv_load($periodeID, $levelID){
	$sql = "SELECT *
			FROM bobot_level
			WHERE ID_PERIODE='$periodeID' AND
			ID_LEVEL='$levelID'";
	return mysql_query($sql);
}

/**
 * 
 * @param $periodeID
 * @param $level (string) - Vertical (VC) / Horizontal (HZ)
 */
function bobotlv_isExist($periodeID, $levelID=false){
	
}

function bobotlv_count($periodeID, $level){
	$sql = "select count(ID_PERIODE) as JML 
			where  ID_PERIODE = '$periodeID' AND ID_LEVEL like '$level%'";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['JML'];
}

function bobotlv_add($periodeID, $levelID, $levelName, $desc, $bobot){
	$sql = "insert into bobot_level values 
			('$periodeID', '$levelID', '$levelName', '$desc', $bobot)";
	return mysql_query($sql);
}

function bobotlv_update($periodeID, $levelID, $desc, $bobot){
	$sql = "UPDATE bobot_level SET
				DESKRIPSI = '$desc',
				BOBOT = $bobot
			WHERE ID_PERIODE='$periodeID' AND ID_LEVEL='$levelID'";
	return mysql_query($sql);	
}