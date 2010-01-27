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
<?php foreach($LDK as $key=>$value):?>
<tbody>
	<tr <?=tag_zebra($z)?> class="fake" onclick="">
		<?php $bb = mysql_fetch_assoc( bobotlv_load($periodeID, $key) );?>
		<td><img src="image/collapse.gif" style="padding-right:10px" /><h3 style="display: inline;"><?=$bb['NAMA_LEVEL']?></h3></td>
		<td width="25" align="right"><?=$value['BOBOT_LEVEL']?>%</td>
		<td width="25" align="right"><?=!$value['NILAI_LEVEL'] || $value['NILAI_LEVEL']==""? "0" : $value['NILAI_LEVEL']?></td>
		
	</tr>
	<!-- KRITERIA -->
	<?php foreach($value['KRITERIA'] as $kripen):?>
	<tr <?=tag_zebra($z)?>>
		<td><img src="image/collapse.gif" style="padding:0 10px 0 20px" /><?=$kripen['NAMA_KRITERIA']?></td>
		<td width="25" align="right"><?=$kripen['BOBOT'] ?>%</td>
		<td width="25" align="right"><?=!$kripen['NILAI'] || $kripen['NILAI']==""? "0" : $kripen['NILAI']?></td>
	</tr>
	<!-- DETAIL KRITERIA -->
	<?php 	foreach($kripen['DEKRIPEN'] as $dekripen):?>
	<tr <?=tag_zebra($z)?>>
		<td><img src="image/collapse.gif" style="padding:0 10px 0 60px" /><?=$dekripen['NAMA_DETAIL_KRITERIA'];?></td>
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
<div align="right" class="padT5">Nilai Akhir (Horizontal <?=$PERIODE['BOBOT_HORIZONTAL']?>% &amp; Vertikal <?=$PERIODE['BOBOT_VERTIKAL']?>%) : 
	<?php $NA = mysql_fetch_assoc(nilaiAkhir_load($karyID, $dep_div_jabID, $periodeID))?>
	<input type="text" class="fake" value="<?=$NA['NILAI_AKHIR']?>"  style="width:100px; text-align:right;" disabled="disabled"/>
</div>
<div align="right" class="padT5">Nilai rata - rata Periode : 
	<input type="text" class="fake" value="<?=nilaiAkhir_avg($periodeID)?>"  style="width:100px; text-align:right;" disabled="disabled"/>
</div>
<div align="right" class="padT5">Nilai rata - rata Departemen (<?=$JBT['NAMA_DEPARTMENT']?>) : 
	<input type="text" class="fake" value="<?=nilaiAkhir_avg($periodeID, $departemenID);?>" style="width:100px; text-align:right;" disabled="disabled"/>
</div>