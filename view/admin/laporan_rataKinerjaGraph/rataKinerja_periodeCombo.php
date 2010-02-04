<option value="-1">--- pilih ---</option>
<?php $periodeLoop = false ?>
<?php $PERIODE = periode_select(); ?>
<?php while ($row = mysql_fetch_assoc($PERIODE) ):?>
<?php		if ($periodeLoop):?>
	<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
<?php		endif; ?>
<?php		if ($periodeStart===$row['ID_PERIODE']) $periodeLoop=true; ?>
<?php endwhile; ?>