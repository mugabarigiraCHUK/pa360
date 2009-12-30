<form id="frmModal" name="frmModal" action="proc/penilai.php" method="post">
<input type="hidden" value="penilai-save" name="proc" /> 
<input name="periodeID" type="hidden" value="<?=$periodeID?>" />
<input name="karyID" type="hidden" value="<?=$karyID?>" />
<input type="hidden" name="dep_div_jabID" value="<?=$dep_div_jabID?>" />
<input type="hidden" name="stsPenilaian" value="<?=$stsPenilaian?>" />
<input name="penilaiID" type="hidden" value="" />
<input name="dep_div_jabPenilaiID" type="hidden" value="" />
<h2 class="dialog_title"><span>Prosentase Penilaian</span></h2>
<div class="dialog_content">
<div style="border-bottom: 1px solid #CCC">
	<div style="padding:10px">
		<?php $rsKary = kary_load_complete($karyID)?>
		<table width="100%" border="0" cellpadding="5" cellspacing="0">
			<tbody>
			<tr>
				<td width="110" align="right">Periode : </td>
		      <td><strong><?=$periodeID?></strong></td>
			</tr>
			<tr>
              <td align="right">Status Penilaian : </td>
			  <td>
			  	<select name="levelID">
			  	<?php 
					$rsnpp = npp_select("KODE_KARYAWAN='$karyID' AND ID_PERIODE='$periodeID' AND 
										ID_DEP_DIV_JAB='$dep_div_jabID' AND ID_LEVEL LIKE '%$stsPenilaian%'"); 
					
					//cari yang sudah terdaftar
					$found = array();
					while ($npp = mysql_fetch_assoc($rsnpp)){
						$found[$npp['ID_LEVEL']] = true;
					}
					
					$rsp = periode_load($periodeID);
					$rsp = mysql_fetch_assoc($rsp);
					//level depth
					$ld = $stsPenilaian==='HZ'? $rsp['LEVEL_HORIZONTAL'] : ($stsPenilaian==='VC'? $rsp['LEVEL_VERTIKAL'] : 0);
					
					//bikin option element-nya
					for ($i=0; $i<$ld; $i++): 	
						$dd=$stsPenilaian.($i+1);
						if ( $found[$dd] ) { continue; } ?>
					<option value="<?=$stsPenilaian.($i+1)?>"><?=$stsPenilaian.($i+1)?></option>
				<?php endfor;?>
				</select>
			  </td>
			  </tr>
			<tr>
			  <td align="right">Karyawan Penilai  : </td>
			  <td><input name="penilai" type="text" onfocus="penilai_searchKary_modal2()" />
		      <input type="button" name="search" value="Search" class="marginL5" onclick="penilai_searchKary_modal2()" /></td>
			</tr>
			<tr>
			  <td align="right" valign="top">Jabatan : </td>
			  <td><strong id="jabatanNama"></strong></td>
			</tr>
			<tr>
			  <td align="right">Departemen : </td>
			  <td><strong id="departemenNama"></strong></td>
			  </tr>
			<tr>
			  <td align="right">Divisi : </td>
			  <td><strong id="divisiNama"></strong></td>
			  </tr>
			</tbody>
		</table>
	</div>
</div>
<div class="dialog_buttons">
	<input type="button" value="Save" name="save" onclick="this.disabled=true;penilai_save(document.frmModal); FBModal_hide()" />
	<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
</div>
</div>
</form>
