<?php 
$karyID = $_REQUEST['karyID'];
$dep_div_jabID = $_REQUEST['dep_div_jabID'];
$periodeID = $_REQUEST['periodeID'];
$departemenID = $_REQUEST['departemenID'];
$departemenID = $departemenID==='false' || $departemenID===''? false : $departemenID;
?>
<html>
<head>
<link href="css/main.css" rel="stylesheet" type="text/css">
<style>
table {font-family:Geneva, Arial, Helvetica, sans-serif;
	font-size:12px;
	background-color: #F4FFE4;
}

</style>
<script type="text/javascript" src="jscript/moo.js"></script>
<script type="text/javascript" src="jscript/moop.js"></script>
<?php if(function_exists('inject_head')) inject_head(); ?>
</head>

<body style="background-color:#FFFFFF">
<h1 align="center">Laporan Kinerja Karyawan</h1>
<h2 align="center">Periode <?=$periodeID?></h2>
<div style="padding:3px 0 3px 0;">
	<div style="width:90px; position:relative; float:left">Peroide</div>
	<div style="display:inline">: <strong><?=$periodeID?></strong></div>
</div>

<?php $KARY = mysql_fetch_assoc(kary_load($karyID)); ?>
<?php $JBT = mysql_fetch_assoc(RELASIJABATAN_load($karyID, $dep_div_jabID)); ?>
<div style="padding:3px 0 3px 0;">
	<div style="width:90px; position:relative; float:left">Jabatan </div>
	<div style="display:inline">: <strong><?=$JBT['NAMA_JABATAN']?></strong></div>
</div>

<div style="padding:3px 0 3px 0;">
	<div style="width:90px; position:relative; float:left">Departemen</div>
	<div style="display:inline">: <strong><?=$JBT['NAMA_DEPARTMENT']?></strong></div>
</div>

<div style="padding:3px 0 3px 0;">
	<div style="width:90px; position:relative; float:left">Divisi </div>
	<div style="display:inline">: <strong><?=$JBT['NAMA_DIVISI']?></strong></div>
</div>

<?php
	$KEY = array();
	$BBTLV = bobotlv_select(false, $periodeID);
	$ROW_APPENDED = 0;
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] = $row['ID_LEVEL'].' ('.$row['BOBOT'].'%)';
		$ROW_APPENDED++;
	}
	mysql_free_result($BBTLV);
?>
<table class="list" width="100%" cellpadding="5" cellspacing="0">
	<tr class="header">
		<th align="left"><h3><span class="colorWhite">Kriteria / Sub Kriteria</span></h3></th>
		<!--  colspan="3" --><th  width="75" align="right"><h3><span class="colorWhite">Bobot</span></h3></th>
		<!-- colspan="3"  --><th  width="75" align="right"><h3><span class="colorWhite">Nilai</span></h3></th>
	</tr>
<?php $LDK = laporan_detail_kripen($karyID, $dep_div_jabID, $periodeID); ?>
<?php $PENILAI_V1 = ""; ?>
<?php foreach($LDK as $key=>$value):?>
<?php 	
		//hanya untuk simpan penilai vertical 1
		if ($key == ucwords("VC1")) $PENILAI_V1 = $value['PENILAI']; 
?>
<tbody>
	<tr <?=tag_zebra($z)?> class="fake" onClick="">
		<?php $bb = mysql_fetch_assoc( bobotlv_load($periodeID, $key) );?>
	  <td><h3 style="padding-left:00px"><?=$bb['NAMA_LEVEL']?></h3></td>
		<td width="25" align="right"><?=$value['BOBOT_LEVEL']?>%</td>
		<td width="25" align="right"><?=!$value['NILAI_LEVEL'] || $value['NILAI_LEVEL']==""? "0" : $value['NILAI_LEVEL']?></td>
		
	</tr>
	<!-- KRITERIA -->
	<?php foreach($value['KRITERIA'] as $kripen):?>
	<tr <?=tag_zebra($z)?>>
		<td><div style="padding-left:00px"><?=$kripen['NAMA_KRITERIA']?></div></td>
		<td width="25" align="right"><?=$kripen['BOBOT'] ?>%</td>
		<td width="25" align="right"><?=!$kripen['NILAI'] || $kripen['NILAI']==""? "0" : $kripen['NILAI']?></td>
	</tr>
	<!-- DETAIL KRITERIA -->
	<?php 	foreach($kripen['DEKRIPEN'] as $dekripen):?>
	<tr <?=tag_zebra($z)?>>
		<td><div style="padding-left:40px"><?=$dekripen['NAMA_DETAIL_KRITERIA'];?></div></td>
		<td width="25" align="right"><?=$dekripen['BOBOT'] ?>%</td>
		<td width="25" align="right"><?=!$dekripen['NILAI'] || $dekripen['NILAI']==""? "0" : $dekripen['NILAI']?></td>
	</tr>
	<?php 	endforeach; ?>
	<!-- END DETAIL KRITERIA -->
	<?php endforeach;?>
	<!-- END KRITERIA -->
</tbody>	
<?php $z++; endforeach;?>
</table>

<?php $PERIODE = mysql_fetch_assoc(periode_load($periodeID))?>
<?php $NA = mysql_fetch_assoc(nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID))?>
<div align="right" class="padT5">Nilai Akhir (Horizontal <?=$PERIODE['BOBOT_HORIZONTAL']?>% &amp; Vertikal <?=$PERIODE['BOBOT_VERTIKAL']?>%) : <strong><?=number_format($NA['NILAI_AKHIR'],2)?></strong></div>
<div align="right" class="padT5">Nilai rata - rata Periode : <strong><?=nilaiAkhir_avg($periodeID)?></strong></div>
<div align="right" class="padT5">Nilai rata - rata Departemen (<?=$JBT['NAMA_DEPARTMENT']?>) : <strong><?=number_format(nilaiAkhir_avg($periodeID, $departemenID),2);?></strong></div>
<div style="padding-top:50px">
	<div style="float:left; width:300px">
		<div align="center">Penanggung jawab</div>
		<div align="center" style="padding-top:70px"><?=$PENILAI_V1?></div>
	</div>
	<div style="float:right; width:300px">
		<div align="center">Yang dinilia</div>
		<?php $KARY = mysql_fetch_assoc(kary_load($karyID)) ?>
		<div align="center" style="padding-top:70px"><?=$KARY['NAMA_KARYAWAN']?></div>
	</div>
</div>
</body>
</html>