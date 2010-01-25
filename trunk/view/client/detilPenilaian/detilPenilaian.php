<?php
$karyID = $_POST['karyID'];
$periodeID = $_POST['periodeID'];
$dep_div_jabID = $_POST['dep_div_jabID'];
$levelID = $_POST['levelID'];
$nilaiPerPenilaiID = $_POST['nilaiPerPenilaiID'];

//load jabatan karyawan dinilai
$kary_data = mysql_fetch_assoc(kary_load($karyID));
$kary_jabatan = mysql_fetch_assoc(RELASIJABATAN_load($karyID, $dep_div_jabID));

?>
<form name="frmDepen" method="post" action="proc/client/detilPenilaian.php"> 
<input name="proc" type="hidden" value="detilPenilaian-save" />
<input name="karyID" type="hidden" value="<?=$karyID?>" />
<input name="penilaiID" type="hidden" value="<?=$_COOKIE_DATA->username?>" />
<input name="periodeID" type="hidden" value="<?=$periodeID?>" />
<input name="dep_div_jabID" type="hidden" value="<?=$dep_div_jabID?>" />
<input name="levelID" type="hidden" value="<?=$levelID?>" />
<input name="nilaiPerPenilaiID" type="hidden" value="<?=$nilaiPerPenilaiID?>" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100px">Periode : </td>
    <td><input type="text" value="<?=$periodeID?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td width="100px">Karyawan dinilai : </td>
    <td><input type="text" value="<?=$kary_data['NAMA_KARYAWAN']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Jabatan : </td>
    <td><input type="text" value="<?=$kary_jabatan['NAMA_JABATAN']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Departemen  : </td>
    <td><input type="text" value="<?=$kary_jabatan['NAMA_DEPARTMENT']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Divisi : </td>
    <td><input type="text" value="<?=$kary_jabatan['NAMA_DIVISI']?>" disabled="disabled" style="width:400px" class="fake" /></td>
  </tr>
  <tr>
    <td>Level : </td>
    <td><input type="text" disabled="disabled" class="fake" style="width:400px" value="<?=$levelID?>" /></td>
  </tr>
</table>
<?php 
//persiapan untuk bikin tabbedPane
$kripenList = array();
?>
<div id="kriteriaTab" class="padT10" >
	<ul class="tabs_title">
		<?php //bikin tab title, load data kriteria
			$rsKriteria = debotlv_select(false, false, $periodeID, $levelID);
			while ($kripen = mysql_fetch_assoc($rsKriteria)): 
				$kripenList[] = $kripen; 
		?>
		<li title="<?=$kripen['ID_KRITERIA']?>"><?= $kripen['NAMA_KRITERIA']?></li>
		<?php endwhile; ?>		
	</ul>
	<?php foreach ($kripenList as $ll): ?>
	<div id="<?=$ll['ID_KRITERIA']?>" class="tabs_panel">
		<table width="100%" cellpadding="5" cellspacing="0">
			<!--<tr>
				<td colspan="2">
					<a onclick="$('desc-<?=$ll['ID_KRITERIA']?>').reveal(); $(this).nix()">Deskripsi +</a>
					<div id="desc-<?=$ll['ID_KRITERIA']?>" style="display:none"><?=$ll['DESKRIPSI']?></div>
				</td>
			</tr>-->
			<tr class="header">
				<td><h3><span class="colorWhite">Kriteria</span></h3></td>
				<td align="right"><h3><span class="colorWhite">Nilai</span></h3></td>
			</tr>
			<?php $rsDekripen = dekripen_select($ll['ID_KRITERIA']); ?>
			<?php while ($dd = mysql_fetch_assoc($rsDekripen)): ?>
			<tr <?=tag_zebra($z)?> valign="top">
				<td>
					<a class="fake" onclick="$('desc-<?=$ll['ID_KRITERIA'].'-'.$dd['ID_DETAIL_KRITERIA']?>').get('reveal').toggle()" title="deskripsi"><strong><?=$dd['NAMA_DETAIL_KRITERIA']?></strong></a>
					<div id="desc-<?=$ll['ID_KRITERIA'].'-'.$dd['ID_DETAIL_KRITERIA']?>"><?=$dd['DESKRIPSI']?></div>
				</td>
				<td width="10%" align="right">
					<?php $rsDebot = mysql_fetch_assoc( debot_minmax($dd['ID_DETAIL_KRITERIA']) ); ?>
					<div class="spinner" name="dekripen[<?=$ll['ID_KRITERIA']?>][<?=$dd['ID_DETAIL_KRITERIA']?>]" minValue="<?=$rsDebot['MIN']?>" maxValue="<?=$rsDebot['MAX']?>"></div>
				</td>
			</tr>
			<?php $z++; ?>
			<?php endwhile; ?>
		</table>
	</div>
	<?php endforeach; ?>
</div>
<div align="right" class="padT5"><input type="button" name="Save" value="Save" onclick="detil_save($(this).getParent('form'))" /></div>
</form>