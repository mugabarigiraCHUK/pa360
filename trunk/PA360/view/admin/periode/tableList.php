<?php $rest = periode_select($key); ?>
<?php  while ($row = mysql_fetch_assoc($rest)) : ?>
<tr <?=tag_zebra($z++)?>>
	<td width="5%" align="center"><?=$row['ID_PERIODE']?></td>
	<td width="10%" align="center"><?=$row['PERIODE_AWAL']?></td>
	<td width="10%" align="center"><?=$row['PERIODE_AKHIR']?></td>
	<td width="10%" align="center"><?=$row['BATAS_AWAL_PENILAIAN']?></td>
	<td width="10%" align="center"><?=$row['BATAS_AKHIR_PENILAIAN']?></td>
	<td width="10%" align="center"><?=$row['BOBOT_VERTIKAL']?></td>
	<td width="10%" align="center"><?=$row['BOBOT_HORIZONTAL']?></td>
	<td width="10%" align="center"><?=$row['LEVEL_VERTIKAL']?></td>
	<td width="10%" align="center"><?=$row['LEVEL_HORIZONTAL']?></td>
	<td width="5%" align="center"><a onclick="periode_edit('<?=$row['ID_PERIODE']?>')">Edit</a><a class="marginL5" onclick="periode_delete('<?=$row['ID_PERIODE']?>')">Delete</a></td>
</tr>
<?php endwhile; ?>