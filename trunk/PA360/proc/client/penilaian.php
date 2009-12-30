<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include '../../lib/utils/date.php';
include '../../lib/utils/tag.php';
include '../../model/penilai.php';

$proc = $_REQUEST['proc'];

if ($proc === 'dinilai-table'){
	$karyID = $_POST['karyID'];
	$periodeID = $_POST['periodeID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	include '../../view/client/penilaian/penilaian_dinilaiTableList.php';
}