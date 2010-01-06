<!--<form name="frmModal" action="proc/bobotLevel.php" method="post">
<input type="hidden" value="bobotLevel-update" name="proc" /> -->
<h2 class="dialog_title"><span>Add Kriteria </span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
	<div style="padding:10px">
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
			<tbody>
			<tr>
				<td width="80" align="right">Periode : </td>
			    <td width="838"><?=$periodeID?>
		      <input name="periodeID" type="hidden" value="<?=$periodeID?>" /></td>
			</tr>
			<tr>
			  <td align="right">Level : </td>
			  <?php $result = bobotlv_load($periodeID, $levelID); ?>
			  <?php $row = mysql_fetch_assoc($result); ?>
			  <td><?=$row['NAMA_LEVEL']?><input name="levelID" type="hidden" value="<?=$levelID?>" /></td>
			  </tr>
			<tr>
			  <td align="right">Kriteria : </td>
			  <td>&nbsp;</td>
			  </tr>
			</tbody>
		</table>
		<table width="100%" border="0" cellpadding="5" cellspacing="0" class="list marginT5">
          <tr class="header">
			<th width="25px" align="center">&nbsp;</th>
			<th align="center"><h3><span class="colorWhite">ID Kriteria </span></h3></th>
			<th align="left"><h3><span class="colorWhite">Nama Kriteria </span></h3></th>
			<th align="center"><h3><span class="colorWhite">Bobot (%)</span></h3>			  </th>
		  </tr>
          <tbody id="kripen-table" style="overflow:scroll; height:200px;">
		  <?php include 'debotlv_add_tableList.php'; ?>
			</tr>
		  </tbody>
        </table>
	</div>
</div>
<div class="dialog_buttons">
  <input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
<!--</form>-->
