<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/sessionCheck.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/detilBobotLevel.php';
include_once '../../model/nilaiPerKriteria.php';
include_once '../../model/nilaiPerPenilai.php';
include_once '../../model/kriteriaPenilaian.php';
include_once '../../model/periode.php';
include_once '../../model/karyawan.php';

$proc = $_REQUEST['proc'];

if ($proc === 'graph'){
	include("../../lib/pChart/pData.php");  
	include("../../lib/pChart/pChart.php");  
	
	$periodeID = $_POST['periodeID'];
	$kripenID = $_POST['kripenID'];
	$levelID = $_POST['levelID'];
	
	//nilai rata2 kinerja
	$AVG = $MAX = $MIN = $LABEL = array();
	$AVG[] = $MAX[] = $MIN[] = $LABEL[] = "";
	
	if (is_array($kripenID)){
		foreach($kripenID as $dd){
			$DEBOT = debotlv_select(false, false, $periodeID, $levelID, $dd);
			$DEBOT = mysql_fetch_assoc($DEBOT);
			$debotlvID = $DEBOT['ID_DETIL_BOBOT_LEVEL'];
			$AVG[] = npkrt_avg($debotlvID);
			$MIN[] = npkrt_min($debotlvID);
			$MAX[] = npkrt_max($debotlvID);
			
			$KRIPEN = mysql_fetch_assoc(kripen_load($dd));
			$LABEL[] = $KRIPEN['NAMA_KRITERIA'];
		}
	}

	$AVG[] = $MAX[] = $MIN[] = $LABEL[] = "";
	
	$scaleMax = round(max(max($AVG), max($MAX), max($MIN)));
	$scaleMax = $scaleMax+1;
	
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
	$DataSet->SetSerieName("Nilai Kriteria Rata-rata","avg");  
	$DataSet->SetSerieName("Nilai Kriteria Tertinggi","max");  
	$DataSet->SetSerieName("Nilai Kriteria Terendah","min");  
	 
	// Initialise the graph  
	$Test = new pChart(800,550);  
	$Test->setFixedScale( 0, $scaleMax, $scaleMax/2);
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	$Test->setGraphArea(50,30,750,470);
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
	$Test->drawLegend(50,500,$DataSet->GetDataDescription(),255,255,255);     
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",10);     
	$Test->drawTitle(50,22,"Grafik Standart Nilai Kriteria",50,50,50,750);
	
    //create image
    $path = "../../image/cache";
    cleanup_cacheImage($path);	//cleanup old file
    $name = $_COOKIE_DATA->alias .'StandartKriteria-'. time().".png";
	$Test->Render("$path/$name");  
	echo "<img src=\"image/cache/$name\" alt=\"Standart Nila Kriteria\" 
			onclick=\"drill()\" style=\"cursor:pointer\" />";
}

if ($proc === 'drill'){
	$periodeID = $_POST['periodeID'];
	$kripenArr = $_POST['kripenID'];
	$levelID = $_POST['levelID'];
	include '../../view/admin/laporan_standart_kriteria/standart_kriteria_drill.php';
}

if($proc === 'drill-table'){
	$periodeID = $_POST['periodeID'];
	$departemenID = $_POST['departemenID'];
	$constraint = $_POST['constraint'];
	$levelID = $_POST['levelID'];
	$kripenID = $_POST['kripenID'];
	include '../../view/admin/laporan_standart_kriteria/standart_kriteria_drillTable.php';
}
