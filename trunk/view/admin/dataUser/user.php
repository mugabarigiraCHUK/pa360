<form name="frmSearch">
<!-- kary.php -->
<h2 style="border-bottom: 1px solid #CCC">Daftar Karyawan</h2>
<div class="padT5">Search : <input name="key" type="text" style="margin-left:5px; width:500px" onKeyUp="kary_updateList(this.value)" /></div> 
<table class="marginT5" style="border:1px solid #457A3F;" width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr class="header">
    <th width="100" align="left"><h3><span class="colorWhite">Kode</span></h3></th>
    <th align="left"><h3><span class="colorWhite">Nama</span></h3></th>
    <th width="150" align="center"><h3><span class="colorWhite">As Administrator</span></h3></th>
	<th width="150" align="right"></th>
	<td width="10">&nbsp;</td>
  </tr>
  <tbody id="kary-table" style="overflow:scroll; overflow-x:hidden; height:300px;"></tbody>
</table>
<!-- kary.php End-->
</form>