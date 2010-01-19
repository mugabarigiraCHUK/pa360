<div>Search : <input type="text" class="marginL5" style="width:200px;" onkeyup="periode_updateList(this.value)" /></div>
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list marginT5">
  <tr class="header">
  	<td align="center"><h3><span class="colorWhite">ID</span></h3></td>
    <td align="center"><h3><span class="colorWhite">Periode</span></h3></td>
    <td align="center"><h3><span class="colorWhite">Penilaian</span></h3>      </td>
    <td width="20" align="center"><h3><span class="colorWhite">Bobot vertikal (%) </span></h3></td>
    <td width="20" align="center"><h3><span class="colorWhite">Bobot horizontal (%)</span></h3></td>
    <td width="20" align="center"><h3><span class="colorWhite">Level vertikal</span></h3></td>
    <td width="20" align="center"><h3><span class="colorWhite">Level horizontal</span></h3></td>
    <td width="50" align="center">&nbsp;</td>
  </tr>
  <tbody id="periode-table"></tbody>
</table>
<div style="width: 100%" align="right"><a class="fake" onclick="periode_add()">Add</a></div>