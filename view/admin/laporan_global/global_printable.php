<?php 
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
<h1 align="center">Laporan Nilai Akhir </h1>
<h2 align="center">Periode <?=$periodeID?></h2> 
<?php if ($departemenID): ?>
<?php $DEP = departemen_load($departemenID); ?>
<?php $DEP = mysql_fetch_assoc($DEP); ?>
<h2 align="center">Departemen <?=$DEP['NAMA_DEPARTMENT']?></h2>
<?php endif;?>
<p></p>

<!--<div>Periode : <strong><?=$periodeID?></strong></div>
<?php if ($departemenID): ?>
<?php $DEP = departemen_load($departemenID); ?>
<?php $DEP = mysql_fetch_assoc($DEP); ?>
<div>Departemen : <strong><?=$DEP['NAMA_DEPARTMENT']?></strong></div>
<?php endif;?>-->

<div align="left" class="padT5">Nilai rata - rata Periode : <strong><?=nilaiAkhir_avg($periodeID)?></strong></div>
<?php if ($departemenID): ?>
<?php $DEP = mysql_fetch_assoc( departemen_load($departemenID) ); ?>
<div id="depAvgLabelContainer" align="left" class="padT5">Nilai rata - rata Departemen (<span id="depAvgCaption"><?=$DEP['NAMA_DEPARTMENT']?></span>) : <strong><?=nilaiAkhir_avg($periodeID, $departemenID)?></strong></div>
<?php endif; ?>

<table border="0" cellpadding="5" cellspacing="0" style="position:relative" class="list marginT5">
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
<tr class="header">
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Nama Karyawan</span></h3></th>
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Jabatan</span></h3></th> 
	<!-- <th align="left" nowrap="nowrap"><h3><span class="colorWhite">Departemen</span></h3></th>  -->
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Divisi</span></h3></th>
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Grade</span></h3></th>
	<th nowrap="nowrap" align="right"><h3><span class="colorWhite">Nilai Akhir</span></h3></th>
	<?php foreach ($KEY as $key=>$value) : ?>
	<th width="50" align="right"><h3><span class="colorWhite"><?=$value?></span></h3></th>
	<?php endforeach; ?>
</tr>
<tbody>
<?php $data = laporan_global($periodeID, $departemenID)?>
<?php foreach($data as $dd):?>
<tr <?=tag_zebra($z++)?>>
	<td nowrap="nowrap"><?=$dd['NAMA_KARYAWAN']?></td>
	<td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_JABATAN']?></td>
	<!-- <td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_DEPARTMENT']?></td> -->
	<td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_DIVISI']?></td>
	<td nowrap="nowrap" align="center"><?=$dd['GRADE']?></td>
	<td nowrap="nowrap" align="right"><?=$dd['NILAI_AKHIR']?></td>
	<?php foreach($KEY as $key=>$value):?>
	<td align="right" nowrap="nowrap"><?=isset($dd['LEVEL'][$key])? $dd['LEVEL'][$key] : 0?></td>
	<?php endforeach; ?>
</tr>
<?php endforeach;?>
<?php if ($z<=0):?>
<tr <?=tag_zebra($z++)?>>
	<td nowrap="nowrap" colspan="<?=$ROW_APPENDED+6?>" align="center"><h3>No data</h3></td>
</tr>
<?php endif; ?>
</tbody>
</table>
</body>
</html>