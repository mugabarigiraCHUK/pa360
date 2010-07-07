<div>Search : <input id="key" type="text" class="marginL5" style="width:200px;" onkeyup="golongan_updateList(this.value)" /></div>
<table class="marginT5 list" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th><a onclick="golongan_updateList($('key').value, 'ID_GOLONGAN')">ID Golongan</a></th>
    <th><a onclick="golongan_updateList($('key').value, 'NAMA_GOLONGAN')">Nama Golongan</a></th>
    <th>&nbsp;</th>
  </tr>
  <tbody id="golongan-table"></tbody>
</table>
<div style="width:100%" align="right"><a class="fake" onClick="golongan_add()">Add</a></div>