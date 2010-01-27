<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/sessionCheck.php';
include_once '../../lib/utils/tag.php';
include_once '../../model/periode.php';
include_once '../../model/nilaiAkhir.php';

$proc = $_REQUEST['proc'];

if ($proc === 'periode-combo'){
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	include '../../view/admin/laporan_periodeGraph/periodeGraph_periodeCombo.php';
}

if ($proc === 'graph'){
	include("../../lib/pChart/pData.php");  
	include("../../lib/pChart/pChart.php");  
	
	$periodeStart = $_POST['periodeStart'];
	$periodeEnd = $_POST['periodeEnd'];
	
	//nilai rata2 kinerja
	$AVG = $MAX = $MIN = $LABEL = array();
	$AVG[] = $MAX[] = $MIN[] = $LABEL[] = "";
	
	$LOOP = periode_select();
	$doLoop = false;
	while ($loop = mysql_fetch_assoc($LOOP)){
		if ($periodeStart === $loop['ID_PERIODE']) $doLoop = true;
		if ($doLoop){
			$AVG[] = nilaiAkhir_avg($loop['ID_PERIODE']);
			$MAX[] = nilaiAkhir_max($loop['ID_PERIODE']);
			$MIN[] = nilaiAkhir_min($loop['ID_PERIODE']);
			$LABEL[] = date('F', strtotime($loop['PERIODE_AWAL'])) .'-'. date('F Y', strtotime($loop['PERIODE_AKHIR']));
		}
		if ($periodeEnd === $loop['ID_PERIODE']) $doLoop = false;
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
	$Test = new pChart(800,230);  
	//$Test->setFixedScale(-2,8);  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	$Test->setGraphArea(50,30,585,200);  
	$Test->drawFilledRoundedRectangle(7,7,800,223,5,240,240,240);  
	$Test->drawRoundedRectangle(5,5,800,225,5,230,230,230);  
	$Test->drawGraphArea(255,255,255,TRUE);  
	$Test->drawScale($DataSet->GetData(),$DataSet->GetDataDescription(),SCALE_NORMAL,150,150,150,TRUE,0,2);     
	$Test->drawGrid(4,TRUE,230,230,230,50);  
	 
	// Draw the 0 line  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",6);  
	$Test->drawTreshold(1,143,55,72,TRUE,TRUE);  
	 
	// Draw the cubic curve graph  
	$Test->drawLineGraph($DataSet->GetData(),$DataSet->GetDataDescription());  
	$Test->drawPlotGraph($DataSet->GetData(),$DataSet->GetDataDescription(),3,2,255,255,255);

	//label
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);  
	foreach($AVG as $key=>$val){
		if ($val=="") continue;
		$Test->setLabel($DataSet->GetData(),$DataSet->GetDataDescription(),"avg",$LABEL[$key],number_format($val, 3),221,230,174);
	}  
	
	// Finish the graph  
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",8);     
	$Test->drawLegend(600,30,$DataSet->GetDataDescription(),255,255,255);     
	$Test->setFontProperties("../../lib/Fonts/tahoma.ttf",10);     
	$Test->drawTitle(50,22,"Grafik Kinerja Per Periode",50,50,50,585);  
	
	//create image
    $path = "../../image/cache";
    cleanup_cacheImage($path);	//cleanup old file
    $name = $_COOKIE_DATA->alias .'-'. date('Ymd Hsi', time()).".png";
	$Test->Render("$path/$name");  
	echo "<img src=\"image/cache/$name\" alt=\"Kinerja per Departemen\" 
			onclick=\"document.location='image/cache/$name'\" style=\"cursor:pointer\" />";
}