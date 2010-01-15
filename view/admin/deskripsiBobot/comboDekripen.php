<?php $dekripen = dekripen_select($kripenID); ?>
<?php while ($row = mysql_fetch_assoc($dekripen)): ?>
	<option value="<?=$row['ID_DETAIL_KRITERIA']?>"><?=$row['NAMA_DETAIL_KRITERIA']?></option>
<?php endwhile; ?>