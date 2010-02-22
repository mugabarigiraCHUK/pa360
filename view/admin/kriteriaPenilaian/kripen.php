<div>Search : <input type="text" class="marginL5" style="width:200px;" onkeyup="kripen_updateList(this.value)" /></div>
<table class="list marginT5" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="100px" align="center"><h3><span class="colorWhite">ID Kriteria </span></h3></th>
    <th width="150px" align="left"><h3><span class="colorWhite">Nama Kriteria </span></h3></th>
    <th align="left" width="60px"><h3><span class="colorWhite">Nilai<br/>Standart</span></h3></th>
    <th align="left"><h3><span class="colorWhite">Deskripsi</span></h3></th>
    <th width="100" align="right">&nbsp;</th>
    <th width="10">&nbsp;</th>
  </tr>
  <tbody id="kripen-table" style="overflow:scroll; overflow-x:hidden; height:250px; "></tbody>
</table>
<div align="right" class="padT5" style="width:100%"><a class="fake marginR5" onClick="kripen_add()">Add</a></div>
