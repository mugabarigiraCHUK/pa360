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
<table width="1000" border="0" cellpadding="5" cellspacing="0" style="position:relative" class="list table-container">
<tr class="header">
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Nama Karyawan</span></h3></th>
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Jabatan</span></h3></th> 
	<!-- <th align="left" nowrap="nowrap"><h3><span class="colorWhite">Departemen</span></h3></th>  -->
	<th align="left" nowrap="nowrap"><h3><span class="colorWhite">Divisi</span></h3></th>
	<th nowrap="nowrap" align="right"><h3><span class="colorWhite">Grade</span></h3></th>
	<th nowrap="nowrap" align="right"><h3><span class="colorWhite">Nilai Akhir</span></h3></th>
	<?php foreach ($KEY as $key=>$value) : ?>
	<th width="50" align="right"><h3><span class="colorWhite"><?=$value?></span></h3></th>
	<?php endforeach; ?>
	<th nowrap="nowrap"></th>
</tr>
<tbody>
<?php $data = laporan_global($periodeID, $departemenID)?>
<?php foreach($data as $dd):?>
<tr <?=tag_zebra($z++)?> style="cursor:pointer" onclick="show_detil($('tr-<?=$z?>'))">
	<td nowrap="nowrap"><?=$dd['NAMA_KARYAWAN']?></td>
	<td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_JABATAN']?></td>
	<!-- <td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_DEPARTMENT']?></td> -->
	<td nowrap="nowrap"><?=$dd['JABATAN']['NAMA_DIVISI']?></td>
	<td nowrap="nowrap" align="center"><?=$dd['GRADE']?></td>
	<td nowrap="nowrap" align="right"><?=number_format($dd['NILAI_AKHIR'],2)?></td>
	<?php foreach($KEY as $key=>$value):?>
	<td align="right" nowrap="nowrap"><?=isset($dd['LEVEL'][$key])? number_format($dd['LEVEL'][$key],2) : 0?></td>
	<?php endforeach; ?>
	<td align="right">
		<form id="tr-<?=$z?>">
			<input name="karyID" type="hidden" value="<?=$dd['KODE_KARYAWAN']?>" />
			<input name="periodeID" type="hidden" value="<?=$dd['ID_PERIODE']?>" />
			<input name="dep_div_jabID" type="hidden" value="<?=$dd['ID_DEP_DIV_JAB']?>" />
			<input name="departemenID" type="hidden" value="<?=$dd['JABATAN']['ID_DEPARTMENT']?>" />
			<a onClick="show_detil($(this).getParent('form'))">detil</a>
		</form>
	</td>
</tr>
<?php endforeach;?>
<?php if ($z<=0):?>
<tr <?=tag_zebra($z++)?>>
	<td nowrap="nowrap" colspan="<?=$ROW_APPENDED+6?>" align="center"><h3>No data</h3></td>
</tr>
<?php endif; ?>
</tbody>
</table>