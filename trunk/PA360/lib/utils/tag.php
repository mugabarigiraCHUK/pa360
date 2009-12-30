<?php

/**
 * bikin combobox untuk angka
 * @param $start (int) - mulai
 * @param $length (int) - panjangnya
 * @param $selected (int) - nomor yang terpilih (default)
 * @param $name (string) - element name
 * @param $class (string) - element class
 * @param $style (string) - element style
 */
function tag_numberOnSelect($start, $length, $selected=0, $name="", $class="", $style=""){
	$str = "";
	$str = "<select name=\"$name\" style=\"$style\" class=\"$class\">";
	for ($i=0; $i<$length; $i++){
		$str .= "<option value=\"". ($i+$start) ."\" ".
				($i+$start==$selected? "selected" : "") .
				">". ($i+$start) ."</option>";
	}
	$str .= "</select>";
	return $str;
}

/**
 * style zebra pada baris table
 * @param $z (int) - index baris
 */
function tag_zebra($z){
	$col = array("#FFFFFF", "#F4FFE4");
	$ind = $z%2;
	return "bgcolor=\"$col[$ind]\"";
}