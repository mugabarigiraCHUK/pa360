<?php 
$debotlv = debotlv_select($periodeID, $levelID); 
$selected = array();
while ($row = mysql_fetch_assoc($debotlv)){
	$selected[$row['ID_KRITERIA']] = TRUE;
}
?>
<?php $kripen = kripen_select(); ?>
<?php while ($row = mysql_fetch_assoc($kripen)): ?>
<?php if ($selected[$row['ID_KRITERIA']]) { continue; }//prevent the loop?>
<tr <?=tag_zebra($z++)?>>
<td align="center"><input name="" type="checkbox" value="<?=$row['ID_KRITERIA']?>" onChange="debotlv_saveKriteria('<?=$periodeID?>','<?=$levelID?>','<?=$row['ID_KRITERIA']?>')"></td>
<td align="center"><?=$row['ID_KRITERIA']?></td>
<td><?=$row['NAMA_KRITERIA']?></td>
<td align="center"><?=$row['BOBOT']?></td>
</tr>
<?php endwhile;?>
