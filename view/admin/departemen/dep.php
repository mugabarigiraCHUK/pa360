<div style="padding-left:10px">Search : <input id="key" type="text" class="marginL5" style="width:200px;" onkeyup="departemen_updateList(this.value)" /></div>
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list">
  <tr class="header">
    <th><a onclick="departemen_updateList($('key').value, 'ID_DEPARTMENT')">ID Departemen</a></th>
    <th><a onclick="departemen_updateList($('key').value, 'NAMA_DEPARTMENT')">Nama Departemen</a></th>
    <th>&nbsp;</th>
  </tr>
  <tbody id="departemen-table"></tbody>
</table>
<div style="width:100%" align="right"><a class="fake" onClick="departemen_add()">Add</a></div>