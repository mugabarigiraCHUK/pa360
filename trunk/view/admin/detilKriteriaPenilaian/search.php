<h2 class="dialog_title"><span>Search</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC;">
<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list">
  <tr class="header">
    <th><h3><span class="colorWhite">Kriteria</span></h3></th>
    <th><h3><span class="colorWhite">ID Det. Kriteria</span></h3></th>
    <th><h3><span class="colorWhite">Nama Det. Kriteria</span></h3></th>
  </tr>
  <tbody style="overflow:scroll; height:250px;" >
  <?php $result = dekripen_select(); ?>
  <?php while ($row = mysql_fetch_assoc($result)) : ?>
  <tr height="20px" <?=tag_zebra($z++)?> style="cursor:pointer;" ondblclick="dekripen_edit('<?=$row['ID_DETAIL_KRITERIA']?>')">
    <td align="center"><?=$row['NAMA_KRITERIA']?></td>
    <td align="center"><?=$row['ID_DETAIL_KRITERIA']?></td>
    <td><?=$row['NAMA_DETAIL_KRITERIA']?></td>
  </tr>
  <?php endwhile; ?>
  </tbody>
</table>
</div>
<div class="dialog_buttons"><input type="button" value="Save"
	name="save" onClick="dekripen_save(document.frmModal); FBModal_hide()" />
  <input type="button" value="Close" name="close" onClick="FBModal_hide()" />
</div>
</div>