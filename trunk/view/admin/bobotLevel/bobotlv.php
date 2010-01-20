<div class="padT5">Periode : 
	<?php $rsp = periode_select(); ?>
	<select id="periodeID" name="periodeID" class="marginL5" onchange="bobotLevel_updateList()">
	<?php while ($ll = mysql_fetch_assoc($rsp)) : ?>
		<option value="<?=$ll['ID_PERIODE']?>" <?=$periodeID==$ll['ID_PERIODE']? "selected=\"selected\"" : "" ?> ><?=$ll['ID_PERIODE']?></option>
	<?php endwhile;?>
	</select>
</div>
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list marginT5">
  <tr class="header">
  	<td width="100" align="left"><h3><span class="colorWhite">Level</span></h3></td>
    <td width="100" align="left"><h3><span class="colorWhite">Nama Level</span></h3> </td>
    <td width="100" align="center"><h3><span class="colorWhite">Bobot (%) </span></h3></td>
    <td align="left"><h3><span class="colorWhite">Deskripsi</span></h3></td>
    <td width="100" align="center">&nbsp;</td>
  </tr>
  <tbody id="bobotlv-table"></tbody>
</table>
<!--<div style="width: 100%" align="right"><a class="fake" onclick="bobotLevel_add()">Add</a></div>-->