<?php
function tag_select_year($year, $year_start, $year_length, $name="", $class="", $style=""){
	$res = "<select name=\"$name\" class=\"$class\" style=\"$style\">";
		for ($i=$year_length; $i>0; $i--){
			$res .= "<option value=\"". ($year_start+$i) ."\" ";
			$res .= $year_start+$i==$year? "selected=\"selected\"" : "";
			$res .= ">". ($year_start+$i) ."</option>";
		}
	$res .= "</select>";
	return $res;
}

function tag_select_month($month, $name="", $class="", $style=""){
	$mm = array(
		'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember',
	);
	$res = "<select name=\"$name\" class=\"$class\" style=\"$style\">";
		for ($i=0; $i<12; $i++){
			$res .= "<option value=\"". ($i+1) ."\"";
			$res .= ($mm[$i]===$month || $i+1==$month)? "selected=\"selected\"" : "";
			$res .= ">$mm[$i]</option>";
		}
	$res .= "</select>";
	return $res;
}

function tag_select_date($date, $name="", $class="", $style=""){
	$res = "<select name=\"$name\" class=\"$class\" style=\"$style\">";
		for ($i=0; $i<31; $i++){
			$res .= "<option value=\"". ($i+1) ."\"";
			$res .=  $i+1==$date? "selected=\"selected\"" : "";
			$res .= ">". ($i+1) ."</option>";
		}
	$res .="</select>";
	return $res;
}

/**
 * full month
 * @param $int (int) - month dalam integer
 */
function toMonth($int){
	$mm = array( 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni','Juli',
		'Agustus', 'September', 'Oktober', 'November', 'Desember');
	return $mm[abs($int)-1];
}