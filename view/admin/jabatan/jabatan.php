<div>Search : <input id="key" type="text" class="marginL5" style="width:200px;" onkeyup="jabatan_updateList(this.value)" /></div>
<table class="marginT5 list" width="100%" border="0" cellpadding="5" cellspacing="0">
	<tr class="header">
		<th><a onclick="jabatan_updateList($('key').value, 'ID_JABATAN')">ID Jabatan</a></th>
		<th><a onclick="jabatan_updateList($('key').value, 'NAMA_JABATAN')">Nama Jabatan</a></th>
		<th><a onclick="jabatan_updateList($('key').value, 'LEVEL_JABATAN')">Level Jabatan</a></th>
		<th>&nbsp;</th>
	</tr>
	<tbody id="jabatan-table"></tbody>
</table>
<div style="width:100%" align="right"><a class="fake" onclick="jabatan_add()">Add</a></div>
