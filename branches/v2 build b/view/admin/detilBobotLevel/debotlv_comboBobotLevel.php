<?php $pp = bobotlv_select(false, $periodeID)?>
<?php while ($row = mysql_fetch_assoc($pp)): ?>
	<option value="<?=$row['ID_LEVEL']?>"><?=$row['NAMA_LEVEL']?></option>
<?php endwhile;?>
