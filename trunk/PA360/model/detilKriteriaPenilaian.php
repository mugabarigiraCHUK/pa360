<?php

function dekripen_select($kripenID=false, $dekripenID=false, $key=false){
	$sql = "select
				b.ID_KRITERIA,
				a.NAMA_KRITERIA,
				b.ID_DETAIL_KRITERIA,
				b.NAMA_DETAIL_KRITERIA,
				b.DESKRIPSI,
				b.BOBOT
			from 
				kriteria_penilaian as a, 
				detail_kriteria as b 
			where a.ID_KRITERIA = b.ID_KRITERIA ";
	
	if ($kripenID){
		$sql .= " AND ";
		$sql .= "b.ID_KRITERIA = '$kripenID' ";
	}
	
	if ($dekripenID){
		$sql .= " AND ";
		$sql .= "b.ID_DETAIL_KRITERIA = '$dekripenID' ";
	}
	
	if ($key){
		$sql .= " AND (";
		$sql .= "b.ID_DETAIL_KRITERIA like '%$key%' OR  
				a.NAMA_KRITERIA like '%$key%' OR
				b.ID_DETAIL_KRITERIA like '%$key%' OR
				b.NAMA_DETAIL_KRITERIA like '%$key%' OR
				b.DESKRIPSI like '%$key%' OR
				b.BOBOT like '%$key%')";
	}
			
	return mysql_query($sql);
}

function dekripen_load($id){
	$sql = "select
				b.ID_KRITERIA,
				a.NAMA_KRITERIA,
				b.ID_DETAIL_KRITERIA,
				b.NAMA_DETAIL_KRITERIA,
				b.DESKRIPSI,
				b.BOBOT
			from 
				kriteria_penilaian as a, 
				detail_kriteria as b 
			where 
				a.ID_KRITERIA = b.ID_KRITERIA AND
				b.ID_DETAIL_KRITERIA = '$id'";
	return mysql_query($sql);
}

function dekripen_isExistID($id){
	$result = dekripen_load($id);
	$result = mysql_fetch_assoc($result);
	if ($result['ID_DETAIL_KRITERIA'] === $id) return true;
	return false;
}

/**
 * menghitung total bobot dari data dalam tabel
 * @param $kripenID (string) - id kriteria
 * @param $excDekripenID (string) - id detil kriteria
 */
function dekripen_summarize($kripenID=false, $excDekripenID=false){
	$sql = "select sum(BOBOT) as SUM
			from detail_kriteria ";
	
	$sql .= $kripenID || $excDekripenID? " where " : "";
	if ($kripenID){
		$sql .= " ID_KRITERIA = '$kripenID' ";
	}
	if ($excDekripenID){
		$sql .= $kripenID? " AND " : "";
		$sql .= " ID_DETAIL_KRITERIA != '$excDekripenID'";
	}
	
	$result = mysql_fetch_assoc(mysql_query($sql));
	$total = $result['SUM'];

	return $total;
}

/**
 * insert data divisi
 * @param $divID (string) - kode divisi
 * @param $depID (string) - kode departemen
 * @param $divNama (string) - nama divisi
 */
function dekripen_add($kripenID, $dekripenID, $nama, $desc, $bobot){
	$sql = "insert into detail_kriteria ".
			"values ('$dekripenID', '$kripenID', '$nama', '$desc', $bobot)";
	return mysql_query($sql);
}

function dekripen_update($kripenID, $dekripenID, $nama, $desc, $bobot){
	$sql = "update detail_kriteria ".
			"set ID_KRITERIA = '$kripenID',  
				NAMA_DETAIL_KRITERIA = '$nama',
				DESKRIPSI = '$desc',
				BOBOT = $bobot 
			where ID_DETAIL_KRITERIA='$dekripenID'";
	return mysql_query($sql);
}

/**
 * delete data divisi
 * @param $divID (string) - kode divisi
 */
function dekripen_delete($dekripenID){
	$sql = "delete from detail_kriteria ".
			"where ID_DETAIL_KRITERIA='$dekripenID'";
	return mysql_query($sql);
}