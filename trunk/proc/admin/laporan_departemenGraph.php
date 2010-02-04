<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/sessionCheck.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/periode.php';
include_once '../../model/departemen.php';
include_once '../../model/nilaiAkhir.php';

$proc = $_REQUEST['proc'];

if ($proc === 'graph'){
	include("../../lib/pChart/pData.php");  
	include("../../lib/pChart/pChart.php");  
	
	$periodeID = $_POST['periodeID'];
	$departemenID = $_POST['departemenID'];
	
	//nilai rata2 kinerja
	$AVG = $MAX = $MIN = $LABEL = array();
	$AVG[] = $MAX[] = $MIN[] = $LABEL[] = "";
	
	if (is_array($departemenID)){
		foreach($departemenID as $dd){
			$AVG[] = nilaiAkhir_avg($periodeID, $dd);
			$MAX[] = nilaiAkhir_max($periodeID, $dd);
			$MIN[] = nilaiAkhir_min($periodeID, $dd);
			$DEP = mysql_fetch_assoc(departemen_load($dd));
			$LABEL[] = substr($DEP["NAMA_DEPARTMENT"], 0,15);
		}
	}
	$AVG[] = $MAX[] = $MIN[] = $LABEL[] = "";
		  
	// Dataset definition   
	$DataSet = new pData;  
	$DataSet->AddPoint($AVG,"avg");  
	$DataSet->AddPoint($MAX,"max");
	$DataSet->AddPoint($MIN,"min");
	$DataSet->AddPoint($LABEL,"Label");  
	$DataSet->AddSerie("avg");
	$DataSet->AddSerie("max");
	$DataSet->AddSerie("min");
	$DataSet->SetAbsciseLabelSerie("Label");  
	$DataSet->SetSerieName("Nilai Kinerja Rata-rata","avg");  
	$DataSet->SetSerieName("Nilai Kinerja Tertinggi","max");  
	$DataSet->SetSerieName("Nilai Kinerja Terendah","min");  
	 
	// Initialise the graph  
	$Test = new pChart(800,500);  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	$Test->setGraphArea(50,30,585,470);
	//$Test->drawFilledRoundedRectangle(7,7,800,223,5,240,240,240);  
	//$Test->drawRoundedRectangle(5,5,800,225,5,230,230,230);  
	$Test->drawGraphArea(255,255,255,TRUE);  
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_ADDALL,150,150,150,TRUE,0,2);     
	$Test->drawGrid(4,TRUE,230,230,230,50);  

	// Draw the 0 line  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",6);  
	$Test->drawTreshold(1,143,55,72,TRUE,TRUE);
	 
	// Draw the cubic curve graph  
	$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
	$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);
	 
	//label
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	foreach($LABEL as $key=>$val){
		if ($val=="") continue;
		if ($AVG[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"avg",$val,number_format($AVG[$key],2),46,151,224,255,255,255);
		if ($MAX[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"max",$val,number_format($MAX[$key],2),176,24,224,255,255,255);
		if ($MIN[$key]>0) $Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"min",$val,number_format($MIN[$key],2),224,46,117,255,255,255);
	}  
	
	// Finish the graph  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);     
	$Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);     
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",10);     
	$Test->drawTitle(50,22,"Grafik Kinerja Per Departemen",50,50,50,585);  
	
    //create image
    $path = "../../image/cache";
    cleanup_cacheImage($path);	//cleanup old file
    $name = $_COOKIE_DATA->alias .'KinerjaPerDepartemen-'. time().".png";
	$Test->Render("$path/$name");  
	echo "<img src=\"image/cache/$name\" alt=\"Kinerja per Departemen\" 
			onclick=\"document.location='image/cache/$name'\" style=\"cursor:pointer\" />";
}