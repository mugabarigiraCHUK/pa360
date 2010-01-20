<?php $periodeLoop = false ?>
<?php $PERIODE = periode_select(); ?>
<?php while ($row = mysql_fetch_assoc($PERIODE) ):?>
<?php		if ($periodeLoop):?>
	<option value="<?=$row['ID_PERIODE']?>" <?=$periodeEnd===$row['ID_PERIODE']? "selected=\"selected\"" : ""?>><?=$row['ID_PERIODE']?></option>
<?php		endif; ?>
<?php		if ($periodeStart===$row['ID_PERIODE']) $periodeLoop=true; ?>
<?php endwhile; ?>