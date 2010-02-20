<form name="frmSearch" onsubmit="return false">
<div>Periode : 
	<?php $res = periode_select(); ?>
	<select id="periodeID" name="periodeID" class="" onchange="update_table(this.getParent('form'))" style="display: inline">
	<?php while ($ll = mysql_fetch_assoc($res)) : ?>
	<?php $periodeID= $periodeID==""? $ll['ID_PERIODE'] : $periodeID?>
		<option value="<?=$ll['ID_PERIODE']?>" <?=$periodeID===$ll['ID_PERIODE']? "selected=\"selected\"" : "" ?> ><?=$ll['ID_PERIODE']?></option>
	<?php endwhile;?>
	</select>
</div>
</form>
<table class="marginT5 list" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th><h3><span class="colorWhite">Grade</span></h3></th>
    <th><h3><span class="colorWhite">Nilai Minimal</span></h3></th>
    <th><h3><span class="colorWhite">Nilai Maksimal</span></h3></th>
    <th>&nbsp;</th>
  </tr>
  <tbody id="grade-table"></tbody>
</table>
<div style="width:100%" align="right"><a class="fake" onClick="add()">Add</a></div>