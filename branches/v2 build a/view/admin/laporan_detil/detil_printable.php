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

<body>
	<table width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr>
		<td width="100">Periode </td>
		<td>: <?=$periodeID?></td>
	</tr>
	<?php $KARY = mysql_fetch_assoc(kary_load($karyID)); ?>
	<?php $JBT = mysql_fetch_assoc(RELASIJABATAN_load($karyID, $dep_div_jabID)); ?>
	<tr>
		<td>Karyawan </td>
		<td>: <?=$KARY['NAMA_KARYAWAN']?> (<?=$karyID?>)</td>
	</tr>
	<tr>
		<td>Jabatan </td>
		<td>: <?=$JBT['NAMA_JABATAN']?></td>
	</tr>
	<tr>
		<td>Departemen</td>
		<td>: <?=$JBT['NAMA_DEPARTMENT']?></td>
	</tr>
	<tr>
		<td>Divisi</td>
		<td>: <?=$JBT['NAMA_DIVISI']?></td>
	</tr>
</table>
<?php
	$KEY = array();
	$BBTLV = bobotlv_select($periodeID);
	$ROW_APPENDED = 0;
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] = $row['ID_LEVEL'].' ('.$row['BOBOT'].'%)';
		$ROW_APPENDED++;
	}
	mysql_free_result($BBTLV);
?>
<?php $PP = mysql_fetch_assoc(periode_load($periodeID)); ?>
<?php $tableW = 25+350+(50*($PP['LEVEL_VERTIKAL'] + $PP['LEVEL_HORIZONTAL']))+10?>
<table width="<?=$tableW<900? 900 : tableW?>" border="0" cellpadding="5" cellspacing="0" class="list">
<tr class="header">
	<th width="25"><h3><span class="colorWhite">No</span></h3></th>
	<th width="350"><h3><span class="colorWhite">Kriteria / Sub Kriteria</span></h3></th>
	<?php foreach ($KEY as $key=>$value) : ?>
	<th width="50" align="right"><h3><span class="colorWhite"><?=$value?></span></h3></th>
	<?php endforeach; ?>
	<th width="10"></th>
</tr>

<?php $row=$z=$y=0;?>
<?php $KRITERIA = laporan_detail_kripen($karyID, $dep_div_jabID, $periodeID); ?>
<?php foreach($KRITERIA as $kripen) :?>
<!-- kriteria -->
<tr <?=tag_zebra($z)?> valign="top">
	<td width="10" align="center"><?=++$row?>.</td>
	<td width="350">
		<div>
			<img class="link marginR5" src="image/collapse.gif" onClick="
				this.src=this.src.match(/image\/expand\.gif/)?
					this.src.replace(/image\/expand\.gif/,'image/collapse.gif') : 
					this.src.replace(/image\/collapse\.gif/,'image/expand.gif'); 
				$$('tr.tr-<?=$z?>').toggle();" />
			<strong style="text-decoration:underline; cursor:pointer" onClick="$('desc-<?=$z?>').get('reveal').toggle()">
				<?=$kripen['NAMA_KRITERIA']?>&nbsp;&nbsp; (<?=$kripen['BOBOT']?>%)
			</strong>
		</div>
		<div id="desc-<?=$z?>" style="font-size:10px;display:none;"><?=$kripen['DESKRIPSI']?></div>
	</td>
	<?php foreach ($KEY as $key=>$value) : ?>
	<td width="50" align="right"><strong><?=$kripen[$key]==NULL? 0 : $kripen[$key]?></strong></td>
	<?php endforeach; ?>
	<td width="10"></td>
</tr>
	<?php $DEKRIPEN = laporan_detail_dekripen($karyID, $dep_div_jabID, $periodeID, $kripen['ID_KRITERIA']); ?>
	<?php foreach($DEKRIPEN as $dekripen) :?>
	<!-- sub kriteria -->
	<tr <?=tag_zebra($z)?> class="tr-<?=$z?>" valign="top">
		<td width="10"></td>
		<td width="350">
			<div style="margin-left:20px;">
				<span style="cursor:pointer" onClick="$('desc-sub-<?=$z.$y?>').get('reveal').toggle()"><?=$dekripen['NAMA_DETAIL_KRITERIA']?>&nbsp;&nbsp; (<?=$dekripen['BOBOT']?>%)</span>
			</div>
			<div id="desc-sub-<?=$z.$y?>" style="margin-left:20px; font-size:10px; display:none"><?=$dekripen['DESKRIPSI']?></div>
		</td>
		<?php foreach ($KEY as $key=>$value) : ?>
		<td width="50" align="right"><div style="margin-right:25px"><?=$dekripen[$key]==NULL? 0 : $dekripen[$key]?></div></td>
		<?php endforeach; ?>
		<td width="10"></td>
	</tr>
	<!-- end sub kriteria -->
	<?php $y++; endforeach;?>
<!-- end kriteria -->
<?php $z++; endforeach; ?>
</table>
<?php $PERIODE = mysql_fetch_assoc(periode_load($periodeID))?>
<?php $NA = mysql_fetch_assoc(nilaiAkhir_load($karyID, $periodeID, $dep_div_jabID))?>
<div class="padT5">Nilai Akhir (Horizontal <?=$PERIODE['BOBOT_HORIZONTAL']?>% &amp; Vertikal <?=$PERIODE['BOBOT_VERTIKAL']?>%) : <?=$NA['NILAI_AKHIR']?></div>
<div class="padT5">Nilai rata - rata Periode : <?=nilaiAkhir_avg($periodeID)?></div>
<div class="padT5">Nilai rata - rata Departemen (<?=$JBT['NAMA_DEPARTMENT']?>) : <?=nilaiAkhir_avg($periodeID, $departemenID);?></div>
</body>
</html>