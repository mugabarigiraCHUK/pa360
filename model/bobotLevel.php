<?php

$_BOBOT_LEVEL_KEY = array(
	"HORIZONTAL" => "HZ",
	"VERTICAL" => "VC"
);

/**
 * 
 * @param $periodeID
 */
function bobotlv_select($id=false, $periodeID=false, $levelID=false){
	$sql = "SELECT * FROM bobot_level";
	if ($id){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= "ID_BOBOT_LEVEL=$id";
	}
	if ($periodeID){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= "ID_PERIODE='$periodeID'";
	}
	if ($levelID){
		$sqlw .= $sqlw==""? "" : " AND ";
		$sqlw .= "ID_LEVEL='$levelID'";
	}
	$sqlw = " WHERE ".$sqlw;
	$sqlo = " ORDER BY ID_PERIODE, ID_LEVEL ASC"; 
	return mysql_query($sql.$sqlw.$sqlo);
}

/**
 * 
 * @param $periodeID
 * @param $level (string) - level id
 */
function bobotlv_load($periodeID, $levelID){
	return bobotlv_select(false, $periodeID, $levelID);
}

function bobotlv_loadByID($id){
	return bobotlv_select($id);
}

/**
 * 
 * @param $periodeID
 * @param $level (string) - Vertical (VC) / Horizontal (HZ)
 */
function bobotlv_isExistID($bobotLvID){
	$res = bobotlv_loadByID($bobotLvID);
	while ($rr = mysql_fetch_assoc($res)){ return true; }
	return false;
}

function bobotlv_isExist($periodeID, $levelID){
	$sql = bobotlv_select(false, $periodeID, $levelID);
	while ($row = mysql_fetch_assoc($sql)){
		return true;
	}
	return false;
}

function bobotlv_count($periodeID, $level){
	$sql = "select count(ID_PERIODE) as JML 
			FROM bobot_level
			where  ID_PERIODE = '$periodeID' AND ID_LEVEL like '$level%'";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['JML'];
}

function bobotlv_sum($periodeID, $levelID_exclude){
	$sql = "select sum(BOBOT) as JML 
			FROM bobot_level
			where ID_PERIODE = '$periodeID' ";
	
	if (is_array($levelID_exclude)){
		foreach($levelID_exclude as $xx){
			$sql.= " AND ID_LEVEL != '$xx' ";		
		}
	}
	elseif ($levelID_exclude){
		$sql.= " AND ID_LEVEL != '$levelID_exclude' ";
	}
	
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	return $res['JML'];
}

function bobotlv_add($periodeID, $levelID, $levelName, $desc, $bobot){
	$sql = "insert into bobot_level (ID_PERIODE, ID_LEVEL, NAMA_LEVEL, DESKRIPSI, BOBOT)
			values ('$periodeID', '$levelID', '$levelName', '$desc', $bobot)";
	return mysql_query($sql);
}

function bobotlv_update($id, $periodeID, $levelID, $levelName=false, $desc=false, $bobot=false){
	$sqls = "";
	if ($desc){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "DESKRIPSI='$desc'";
	}
	if ($bobot){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "BOBOT='$bobot'";
	}
	if ($levelName){
		$sqls .= $sqls==""? "" : ",";
		$sqls .= "NAMA_LEVEL='$levelName'";
	}
	$sql = "UPDATE bobot_level SET $sqls
			WHERE ID_BOBOT_LEVEL='$id' AND ID_PERIODE='$periodeID' AND ID_LEVEL='$levelID'";
	return mysql_query($sql);	
}

function bobotlv_deleteWhere($where){
	$sql = "DELETE FROM bobot_level where $where";
	return mysql_query($sql);	
}

function bobotlv_delete($id){
	return bobotlv_deleteWhere("ID_BOBOT_LEVEL=$id");
}