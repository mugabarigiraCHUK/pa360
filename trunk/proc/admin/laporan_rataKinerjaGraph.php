<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include_once '../../lib/sessionCheck.php';
include_once '../../model/periode.php';
include_once '../../model/nilaiAkhir.php';
include_once '../../model/deskripsiBobot.php';

$proc = $_REQUEST['proc'];

if ($proc === 'periode-combo'){
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	include '../../view/admin/laporan_rataKinerjaGraph/rataKinerja_periodeCombo.php';
}

if ($proc === 'graph'){
	include("../../lib/pChart/pData.php");  
	include("../../lib/pChart/pChart.php");  
	
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	
	//nilai rata2 kinerja
	$EQUAL = $ABOVE = $UNDER = $LABEL = array();
	$EQUAL[] = $ABOVE[] = $UNDER[] = $LABEL[] = "";
	
	$LOOP = periode_select();
	$doLoop = false;
	while ($loop = mysql_fetch_assoc($LOOP)){
		if ($periodeStart === $loop['ID_PERIODE']) $doLoop = true;
		if ($doLoop){
			$AVG = nilaiAkhir_avg($loop['ID_PERIODE']);
			$EQUAL[] = nilaiAkhir_count($loop['ID_PERIODE'], false, " NILAI_AKHIR BETWEEN $AVG-0.05 AND $AVG+0.05 ");
			$ABOVE[] = nilaiAkhir_count($loop['ID_PERIODE'], false, " NILAI_AKHIR>$AVG+0.05");
			$UNDER[] = nilaiAkhir_count($loop['ID_PERIODE'], false, " NILAI_AKHIR<$AVG-0.05");
			$LABEL[] = date('F', strtotime($loop['PERIODE_AWAL'])) .'-'. date('F Y', strtotime($loop['PERIODE_AKHIR']));
		}
		if ($periodeEnd === $loop['ID_PERIODE'] || $periodeEnd < 0) $doLoop = false;
	}
	$EQUAL[] = $ABOVE[] = $UNDER[] = $LABEL[] = "";	//data beautification
	
	// Dataset definition   
	$DataSet = new pData;  
	$DataSet->AddPoint($ABOVE,"above");
	$DataSet->AddPoint($EQUAL,"equal");  
	$DataSet->AddPoint($UNDER,"under");
	$DataSet->AddPoint($LABEL,"Label");
	$DataSet->AddSerie("above");  
	$DataSet->AddSerie("equal");
	$DataSet->AddSerie("under");
	$DataSet->SetAbsciseLabelSerie("Label");  
	$DataSet->SetSerieName("Jml diatas Rata-rata","above");
	$DataSet->SetSerieName("Jml rata-rata","equal");    
	$DataSet->SetSerieName("Jml dibawah Rata-rata","under");  
	 
	// Initialise the graph  
	$Test = new pChart(800,500);  
	$Test->setFixedScale( 0, intval($minmaxValue['MAX']));
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	$Test->setGraphArea(50,30,585,470);
	//$Test->drawFilledRoundedRectangle(7,7,800,223,5,240,240,240);  
	//$Test->drawRoundedRectangle(5,5,800,225,5,230,230,230);  
	$Test->drawGraphArea(255,255,255,TRUE);  
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,150,150,150,TRUE,0,2);     
	$Test->drawGrid(4,TRUE,230,230,230,50);  
	 
	// Draw the 0 line  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",6);  
	$Test->drawTreshold(0,143,55,72,TRUE,TRUE);  
	 
	// Draw the cubic curve graph  
	$Test->drawBarGraph($DataSet->GetData(),$DataSet->GetDataDescription(),TRUE);  
	 
	//label
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);
	$Test->writeValues($DataSet->GetData(),$DataSet->GetDataDescription(),array("above","equal","under"));
	foreach($LABEL as $key=>$val){
		if ($val=="") continue;
//		if ($ABOVE[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"above",$val,number_format($ABOVE[$key], 3),221,230,174);
//		if ($EQUAL[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"equal",$val,number_format($EQUAL[$key], 3),237,180,187);
//		if ($UNDER[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"under",$val,number_format($UNDER[$key], 3),223,224,134);
	}  
	
	// Finish the graph  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);     
	$Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);     
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",10);     
	$Test->drawTitle(50,22,"Grafik Rata-rata Kinerja Karyawan",50,50,50,585);  
	
	//create image
    $path = "../../image/cache";
    cleanup_cacheImage($path);	//cleanup old file
    $name = $_COOKIE_DATA->alias .'RataKinerjaKaryawan-'. time().".png";
	$Test->Render("$path/$name");  
	echo "<img src=\"image/cache/$name\" alt=\"Grafik rata-rata kinerja karyawan\" 
			onclick=\"document.location='image/cache/$name'\" style=\"cursor:pointer\" />";
}