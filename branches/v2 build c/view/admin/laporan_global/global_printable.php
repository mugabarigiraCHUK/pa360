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

<body>
	<div>Periode : <strong><?=$periodeID?></strong></div>
	<?php if ($departemenID): ?>
 	<?php $DEP = departemen_load($departemenID); ?>
	<?php $DEP = mysql_fetch_assoc($DEP); ?>
	<div>Departemen : <strong><?=$DEP['NAMA_DEPARTMENT']?></strong></div>
	<?php endif;?>
	<table width="1000" border="0" cellpadding="5" cellspacing="0" style="position:relative" class="list marginT5">
<tr class="header">
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Nama Karyawan</span></h3></th>
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Jabatan</span></h3></th> 
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Departemen</span></h3></th>
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Divisi</span></h3></th>
	<?php $rs = bobotlv_select($periodeID); ?>
	<?php while ($row = mysql_fetch_assoc($rs)) : ?>
	<th width="50" align="right"><h3><span class="colorWhite"><?=$row['ID_LEVEL']?> (<?=$row['BOBOT']?>%)</span></h3></th>
	<?php endwhile; ?>
	<th nowrap="nowrap" align="right"><h3><span class="colorWhite">Nilai Akhir</span></h3></th>
</tr>
<tbody>
<?php
	$KEY = array();
	$BBTLV = bobotlv_select($periodeID);
	$ROW_APPENDED = 0;
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] = $row['ID_LEVEL'];
		$ROW_APPENDED++;
	}
	mysql_free_result($BBTLV);
?>
<?php $data = laporan_global($periodeID, $departemenID)?>
<?php foreach($data as $dd):?>
<tr <?=tag_zebra($z++)?>>
	<td nowrap="nowrap"><?=$dd['NAMA_KARYAWAN']?></td>
	<td nowrap="nowrap"><?=$dd['NAMA_JABATAN']?></td>
	<td nowrap="nowrap"><?=$dd['NAMA_DEPARTMENT']?></td>
	<td nowrap="nowrap"><?=$dd['NAMA_DIVISI']?></td>
	<?php foreach($KEY as $key=>$value):?>
	<td align="right" nowrap="nowrap"><?=$dd[$key]?></td>
	<?php endforeach; ?>
	<td nowrap="nowrap" align="right"><?=$dd['NILAI_AKHIR']?></td>
</tr>
<?php endforeach;?>
<?php if ($z<=0):?>
<tr <?=tag_zebra($z++)?>>
	<td nowrap="nowrap" colspan="<?=$ROW_APPENDED+6?>" align="center"><h3>No data</h3></td>
</tr>
<?php endif; ?>
</tbody>
</table>

	<div class="padT5 marginR5">Nilai rata - rata Periode : <strong><?=nilaiAkhir_avg($periodeID)?></strong></div>
	<div class="padT5" <?= $departemenID===false? 'style="display:none"' : ''?>>Nilai rata - rata Departemen (<span id="depAvgCaption"><?=$DEP['NAMA_DEPARTMENT']?></span>) : <strong><?=nilaiAkhir_avg($periodeID, $departemenID)?></strong></div>

</body>
</html>