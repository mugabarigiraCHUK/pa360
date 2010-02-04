<?php
function periode_genID($periodeAwal, $periodeAkhir){
	$mAwal = date('Y', $periodeAwal);
	$mAkhir = date('Y', $periodeAkhir);
	
	//sama tahun bikin : january - maret 2010
	if ($mAwal == $mAkhir){
		return date('F', $periodeAwal) ." - ". date('F', $periodeAkhir) ." ". $mAkhir;
	}
	else{
		return date('F Y', $periodeAwal) ." - ". date('F Y', $periodeAkhir);
	}
}

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
	//delete all horizontal and vertical
	bobotlv_deleteWhere("ID_PERIODE='$periodeID'");
	
	//save horizontal
	for ($i=0; $i<$lvlH; $i++){
		if (! bobotlv_add($periodeID, "HZ".($i+1), 'Horizontal '.($i+1), 
							'', intval(100/$lvlH))){ return false; }
	}
	//save vertical
	for ($i=0; $i<$lvlV; $i++){
		if (! bobotlv_add($periodeID, "VC".($i+1), 'Vertical '.($i+1), 
							'', intval(100/$lvlV))){ return false; }
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
	//save horizontal
	for ($i=0; $i<$lvlH; $i++){
		if (bobotlv_isExist($periodeID, "HZ".($i+1))){
			$tt = bobotlv_select(false, $periodeID, "HZ".($i+1));
			$tt = mysql_fetch_assoc($tt);
			if (! bobotlv_update($tt['ID_BOBOT_LEVEL'], $periodeID, "HZ".($i+1), 'Horizontal '.($i+1), 
							'', intval(100/$lvlH))){ return false; }
		}
		else {
			if (! bobotlv_add($periodeID, "HZ".($i+1), 'Horizontal '.($i+1), 
							'', intval(100/$lvlH))){ return false; }
		}
	}
	$count = bobotlv_count($periodeID, "HZ");
	//delete kelebihan horizontal
	for ($i=0; $i<$count-$lvlH; $i++){
		bobotlv_deleteWhere("ID_PERIODE='$periodeID' AND ID_LEVEL='"."HZ".($lvlH+$i+1)."'");
	}
	
	//save vertical
	$count = bobotlv_count($periodeID, "VC");
	for ($i=0; $i<$lvlV; $i++){
		if (bobotlv_isExist($periodeID, "VC".($i+1))){
			$tt = bobotlv_select(false, $periodeID, "VC".($i+1));
			$tt = mysql_fetch_assoc($tt);
			if (! bobotlv_update($tt['ID_BOBOT_LEVEL'], $periodeID, "VC".($i+1), 'Vertical '.($i+1), 
							'', intval(100/$lvlV))){ return false; }
		}
		else {
			if (! bobotlv_add($periodeID, "VC".($i+1), 'Vertical '.($i+1), 
						'', intval(100/$lvlV))){ return false; }
		}
	}
	$count = bobotlv_count($periodeID, "VC");
	//delete kelebihan vertical
	for ($i=0; $i<$count-$lvlV; $i++){
		bobotlv_deleteWhere("ID_PERIODE='$periodeID' AND ID_LEVEL='"."VC".($lvlV+$i+1)."'");
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