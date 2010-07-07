<div>Search : 
<input id="key" type="text" class="marginL5" style="width:200px;" onkeyup="divisi_updateList(this.value)" />
</div>
<!--<div>
<a onclick="" class="fake">&lt;&lt;Sebelumnya</a>
<input name="textfield" type="text" id="textfield" size="2" />
/ <span>jml halaman</span>
<a onclick="" class="fake">Selanjutnya &gt;&gt;</a>
</div> 
-->
<table class="marginT5 list" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th><a onclick="divisi_updateList($('key').value, 'ID_DIVISI')" class="colorWhite">ID Divisi</a></th>
    <th><a onclick="divisi_updateList($('key').value, 'NAMA_DIVISI')" class="colorWhite">Nama Divisi</a></th>
    <th>&nbsp;</th>
  </tr>
  <tbody id="divisi-table"></tbody>
</table>
<div style="width:100%" align="right"><a class="fake" onClick="divisi_add()">Add</a></div>