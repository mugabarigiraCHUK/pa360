<form name="frmModal" action="proc/admin/grade.php"> 
<input type="hidden" name="proc" value="11" />
<h2 class="dialog_title"><span>Add Grade </span></h2>
<div class="dialog_content">
  	<div style="padding:10px 20px">
		<div>
			<div style="width:50px; display:inline-table;">Periode</div> :
			<?php $res = periode_select(); ?>
			<select id="periodeID" name="periodeID" class="" onchange="">
			<?php while ($ll = mysql_fetch_assoc($res)) : ?>
			<?php $periodeID= $periodeID==""? $ll['ID_PERIODE'] : $periodeID?>
				<option value="<?=$ll['ID_PERIODE']?>" <?=$periodeID===$ll['ID_PERIODE']? "selected=\"selected\"" : "" ?> ><?=$ll['ID_PERIODE']?></option>
			<?php endwhile;?>
			</select>
		</div>
		<div class="padT5">
			<div style="width:50px; display:inline-table;">Grade</div> : <input name="name" type="text" maxlength="3" style="width: 50px" />
		</div>
		<div class="padT5">
			<?php 
				//ambil nilai bobot minimal dan maksimal
				$DEBOT = mysql_fetch_assoc(debot_minmax());
			?>
			<div style="width:50px; display:inline-table;">Nilai</div> : 
			<div id="min" minValue="0" maxValue="<?php echo $DEBOT['MAX']?>" style="display:inline-table;"></div>
			<div class="padL5 padR5" style="display:inline-table;"> - </div>
			<div id="max" minValue="0" maxValue="<?php echo $DEBOT['MAX']?>" style="display:inline-table;"></div>
		</div>
	</div>
</div>
<div class="dialog_buttons">
	<input type="button" name="Submit" value="Save" onClick="save($(this).getParent('form'))">
	<input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</form>