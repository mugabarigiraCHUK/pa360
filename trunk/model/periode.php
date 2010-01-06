<?php

function periode_select($key=false){
	$sql = "select * from setting_periode";
	if ($key){
		$sql .= " WHERE 
					ID_PERIODE like '%$key%' OR
					PERIODE_AWAL like '%$key%' OR
					PERIODE_AKHIR like '%$key%' OR
					BOBOT_VERTIKAL like '%$key%' OR
					BOBOT_HORIZONTAL like '%$key%' OR
					LEVEL_VERTIKAL like '%$key%' OR
					LEVEL_HORIZONTAL like '%$key%' OR
					BATAS_AWAL_PENILAIAN like '%$key%' OR
					BATAS_AKHIR_PENILAIAN like '%$key%'";
	}
	$sql .= " ORDER BY PERIODE_AWAL ASC ";
	$result = mysql_query($sql);
	return !$result? mysql_error() : $result;
}

function periode_isExistID($id){
	$sql = "select * from setting_periode where ID_PERIODE='$id'";
	$res = mysql_query($sql);
	$res = mysql_fetch_assoc($res);
	if ($res['ID_PERIODE'] === $id) return true;
	return false;
}

/**
 * insert periode
 * @param  $id (string) - kode periode
 * @param  $pAwal (date) - periode awal
 * @param  $pAkhir (date) - periode akhir
 * @param  $bobotV (int) - bobot vertical
 * @param  $bobotH (int) - bobot horizontal
 * @param  $lvlV (int) - jumlah level vertical
 * @param  $lvlH (int) - jumlah level horizontal
 * @param  $pnAwal (date) - batas penilaian awal
 * @param  $pnAkhir (date) - batas penilaian akhir
 */
function periode_add($id, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
					$pnAwal, $pnAkhir){
	$sql = "insert into setting_periode ".
			"values ('$id', '$pAwal', '$pAkhir', $bobotV, $bobotH, $lvlV, $lvlH,
					'$pnAwal', '$pnAkhir')";
	return mysql_query($sql);
}

function periode_addComplete($periodeID, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
					$pnAwal, $pnAkhir){
	/**
	 * save periode
	 */
	if (! periode_add($periodeID, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
						$pnAwal, $pnAkhir)){
		return false;	
	}
					
	/**
	 * save BOBOT_LELVEL untuk level horizontal dan vertical
	 * sebanyak $lvlH dan $lvlV
	 */
	//delete all horizontal
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$periodeID' AND 
				ID_LEVEL like 'HZ%'");
	//save horizontal
	for ($i=0; $i<$lvlH; $i++){
		if (! bobotlv_add($periodeID, "HZ".($i+1), 'Horizontal '.($i+1), 
							'', 100/$lvlH)){ return false; }
	}
	//detele all vertical
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$periodeID' AND 
				ID_LEVEL like 'VC%'");
	//save vertical
	for ($i=0; $i<$lvlV; $i++){
		if (! bobotlv_add($periodeID, "VC".($i+1), 'Vertical '.($i+1), 
						 '', 100/$lvlV)){ return false; }
	}
	
	//from here, all saving complete
	return true;
}

function periode_update($id, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
					$pnAwal, $pnAkhir){
	$sql = "update setting_periode set 
				PERIODE_AWAL = '$pAwal',
				PERIODE_AKHIR = '$pAkhir',
				BOBOT_VERTIKAL = $bobotV,
				BOBOT_HORIZONTAL = $bobotH,
				LEVEL_VERTIKAL = $lvlV,
				LEVEL_HORIZONTAL = $lvlH,
				BATAS_AWAL_PENILAIAN = 	'$pnAwal',
				BATAS_AKHIR_PENILAIAN = '$pnAkhir'
			where 
				ID_PERIODE = '$id'";		
	return mysql_query($sql);
}

function periode_updateComplete($periodeID, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
					$pnAwal, $pnAkhir){
	/**
	 * update periode
	 */
	if (! periode_update($periodeID, $pAwal, $pAkhir, $bobotV, $bobotH, $lvlV, $lvlH, 
						$pnAwal, $pnAkhir)){
		return false;	
	}
					
	/**
	 * save BOBOT_LELVEL untuk level horizontal dan vertical
	 * sebanyak $lvlH dan $lvlV
	 */
	//delete all horizontal
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$periodeID' AND 
				ID_LEVEL like 'HZ%'");
	//save horizontal
	for ($i=0; $i<$lvlH; $i++){
		if (! bobotlv_add($periodeID, "HZ".($i+1), 'Horizontal '.($i+1), 
							'', intval(100/$lvlH))){ return false; }
	}
	//detele all vertical
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$periodeID' AND 
				ID_LEVEL like 'VC%'");
	//save vertical
	for ($i=0; $i<$lvlV; $i++){
		if (! bobotlv_add($periodeID, "VC".($i+1), 'Vertical '.($i+1), 
							'', intval(100/$lvlV))){ return false; }
	}
	
	//from here, all saving complete
	return true;
}

/**
 * delete periode
 * @param $id (string) kode periode
 */
function periode_delete($id){
	$sql = "delete from setting_periode where  ID_PERIODE='$id'";
	return mysql_query($sql);
}

function periode_delete_complete($id){
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$id' AND 
				ID_LEVEL like 'HZ%'");
	mysql_query("delete from bobot_level  
				where ID_PERIODE='$id' AND 
				ID_LEVEL like 'VC%'");
	return periode_delete($id);
}

/**
 * load data periode
 * @param $id (string) kode periode
 */
function periode_load($id){
	$sql = "select * from setting_periode where ID_PERIODE='$id'";
	$res = mysql_query($sql);
	return $res;
}