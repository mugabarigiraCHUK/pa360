<div>Search : <input id="key" type="text" class="marginL5" style="width:200px;" onkeyup="stskary_updateList(this.value)" /></div>
<table class="list marginT5" width="80%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="150" align="center"><a onclick="stskary_updateList($('key').value, 'ID_STATUS_KARYAWAN')">ID Status</a></th>
    <th align="center"><a onclick="stskary_updateList($('key').value, 'NAMA_STATUS')">Nama Status</a></th>
    <th width="100" align="center">&nbsp;</th>
  </tr>
  <tbody id="stskary-table"></tbody>
</table>
<div align="right" class="padT5" style="width:80%"><a class="fake marginR5" onclick="stskary_add()">Add</a></div>
