<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/sessionCheck.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/periode.php';
include_once '../../model/departemen.php';
include_once '../../model/karyawan.php';
include_once '../../model/nilaiAkhir.php';
include_once '../../model/deskripsiBobot.php';

$proc = $_REQUEST['proc'];

if ($proc === 'periode-combo'){
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	include '../../view/admin/laporan_karyawanGraph/karyawanGraph_periodeCombo.php';
}

if ($proc==='searchKary-modal'){
	include '../../view/admin/laporan_karyawanGraph/karyawanGraph_searchKary.php';
}

if ($proc==='searchKary-table'){
	$searchKey = $_POST['searchKey'];
	$departemenID = $_POST['departemenID'];
	include '../../view/admin/laporan_karyawanGraph/karyawanGraph_searchKaryTable.php';
}

if ($proc==='jbt-combo'){
	$karyID = $_POST['karyID'];
	include '../../view/admin/laporan_karyawanGraph/karyawanGraph_jabatanCombo.php';
}


if ($proc === 'graph'){
	include("../../lib/pChart/pData.php");  
	include("../../lib/pChart/pChart.php");  
	
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	$karyID = $_POST['karyID'];
	$dep_div_jabID = $_POST['dep_div_jabID'];
	$DEPDIVJAB = mysql_fetch_assoc(RELASIJABATAN_load($karyID, $dep_div_jabID));
	
	if (!$karyID) {
		echo "<img src=\"\" alt=\"\" onclick=\"\" style=\"cursor:pointer\" />";
		return;	
	}
	
	//nilai rata2 kinerja
	$AVG_PERIODE = $AVG_DEPART = $KARY = $LABEL = array();
	$AVG_PERIODE[] = $AVG_DEPART[] = $KARY[] = $LABEL[] = "";
	
	$LOOP = periode_select();
	$doLoop = false;
	while ($loop = mysql_fetch_assoc($LOOP)){
		if ($periodeStart === $loop['ID_PERIODE']) $doLoop = true;
		if ($doLoop){
			$AVG_PERIODE[] = nilaiAkhir_avg($loop['ID_PERIODE']);
			$AVG_DEPART[] = nilaiAkhir_min($loop['ID_PERIODE'], $DEPDIVJAB['ID_DEPARTMENT']);
			$NA = mysql_fetch_assoc(nilaiAkhir_load($karyID, $dep_div_jabID,  $loop['ID_PERIODE']));
			$KARY[] = $NA['NILAI_AKHIR']==NULL || $NA['NILAI_AKHIR']===''? 0 : $NA['NILAI_AKHIR'];
			$LABEL[] = date('F', strtotime($loop['PERIODE_AWAL'])) .'-'. date('F Y', strtotime($loop['PERIODE_AKHIR']));
		}
		if ($periodeEnd === $loop['ID_PERIODE'] || $periodeEnd<0) $doLoop = false;
	}
	$AVG_PERIODE[] = $AVG_DEPART[] = $KARY[] = $LABEL[] = "";
		  
	// Dataset definition   
	$DataSet = new pData;  
	$DataSet->AddPoint($AVG_PERIODE,"avg_periode");  
	$DataSet->AddPoint($AVG_DEPART,"avg_departemen");
	$DataSet->AddPoint($KARY,"karyawan");
	$DataSet->AddPoint($LABEL,"Label");  
	$DataSet->AddSerie("avg_periode");
	$DataSet->AddSerie("avg_departemen");
	$DataSet->AddSerie("karyawan");
	$DataSet->SetAbsciseLabelSerie("Label");  
	$DataSet->SetSerieName("Nilai Rata-rata Periode","avg_periode");   
	$DataSet->SetSerieName("Nilai Rata-rata Departemen","avg_departemen");
	$DataSet->SetSerieName("Nilai Kinerja Karyawan","karyawan");   
	 
	// Initialise the graph  
	$Test = new pChart(800,500);  
	$Test->setFixedScale( 0, intval($minmaxValue['MAX']));
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	$Test->setGraphArea(50,30,585,470);
	//$Test->drawFilledRoundedRectangle(7,7,800,223,5,240,240,240);  
	//$Test->drawRoundedRectangle(5,5,800,225,5,230,230,230);  
	$Test->drawGraphArea(255,255,255,TRUE);  
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);     
	$Test->drawGrid(4,TRUE,230,230,230,50);  
	 
	// Draw the 0 line  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",6);  
	$Test->drawTreshold(1,143,55,72,TRUE,TRUE);  
	 
	// Draw the cubic curve graph
	//$Test->drawFilledLineGraph($DataSet->GetData(),$DataSet->GetDataDescription(),25,TRUE);  
	$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
	$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

	//label
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	foreach($LABEL as $key=>$val){
		if ($val=="") continue;
		if ($AVG_PERIODE[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"avg_periode",$val,number_format($AVG_PERIODE[$key], 2),46,151,224,255,255,255);
		if ($AVG_DEPART[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"avg_departemen",$val,number_format($AVG_DEPART[$key], 2),176,24,224,255,255,255);
		if ($KARY[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"karyawan",$val,number_format($KARY[$key], 2),224,46,117,255,255,255);
	}  
	
	// Finish the graph  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);     
	$Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);     
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",10);     
	$Test->drawTitle(50,22,"Grafik Kinerja Karyawan per Periode",50,50,50,585);  
	
	//create image
    $path = "../../image/cache";
    cleanup_cacheImage($path);	//cleanup old file
    $name = $_COOKIE_DATA->alias .'KinerjaKaryawanperPeriode-'. time().".png";
	$Test->Render("$path/$name");  
	echo "<img src=\"image/cache/$name\" alt=\"Kinerja Karyawan\" 
			onclick=\"document.location='image/cache/$name'\" style=\"cursor:pointer\" />";
}