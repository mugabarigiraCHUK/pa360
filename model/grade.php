<?php
function grd_select($periodeID){
	$sql = "SELECT * FROM data_grade WHERE ID_PERIODE='$periodeID' ORDER BY GRD_NAME";
	return mysql_query($sql);
}

function grd_load($id){ 
	$sql = "select * from data_grade where GRD_ID='$id'";
	return mysql_query($sql);
}

function grd_insert($nama, $periodeID, $min, $max){
	$sql = "insert into data_grade (GRD_NAME, ID_PERIODE, GRD_MIN, GRD_MAX)". 
			"values ('$nama','$periodeID','$min', '$max')";
	$result = mysql_query($sql);
	return $result;
}

function grd_update($id, $nama, $periodeID, $min, $max){
	$sql = "UPDATE data_grade 
			SET GRD_NAME='$nama', ID_PERIODE='$periodeID', 
				GRD_MIN='$min', GRD_MAX='$max' 
			WHERE GRD_ID='$id'";
	$result = mysql_query($sql);
	return $result;
}

function grd_delete($id){
	$sql = "DELETE from data_grade 
			WHERE GRD_ID='$id'";
	$result = mysql_query($sql);
	return $result;
}

function grd_translate($periodeID, $score){
	$sql = "SELECT GRD_NAME FROM `data_grade` WHERE '$score' between GRD_MIN AND GRD_MAX";
	while ( $row = mysql_fetch_assoc(mysql_query($sql)) ){ return $row['GRD_NAME']; }
	return false;
}