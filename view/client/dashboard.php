<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';
 
function inject_head(){?>
<script type="text/javascript" src="jscript/md5.js"></script>
<script>
	function update_periodeCombo(form){
		FBModal_loading("Loading", "Please wait...", true, false, 1500);
		form.proc.value="periode-combo";
		form.periodeEnd.set('html', "");
		doRequest('proc/admin/laporan_karyawanGraph.php', 'post', 
				'proc=periode-combo'+
				'&periodeStart='+form.periodeStart.value, 
				function (res){ 
			FBModal_hide();	
			form.periodeEnd.set('html', res);
			update_graph(form);
			});
	}
	
	function searchKary_modal(){
		FBModal_show2('proc/admin/laporan_karyawanGraph.php','post', "proc=searchKary-modal", true, true);
	}
	
	function searchKary_updateTable(form){
		form.set('send', {
			onSuccess: function(response) {
				$('searchKary-table').set('html', response);
			}
		}).send();
	}
	
	function searchKary_pick(karyID, karyNama){
		FBModal_hide();
		var form = $(document.frmSearch);
		form.karyLabel.value = karyNama;
		if (form.karyID.value != karyID){
			form.karyID.value = karyID;
			updateJabatanCombo($(document.frmSearch));
		}
	}

	function updateJabatanCombo(form){
		if (form.karyID.value=='') { return; }
		doRequest('proc/admin/laporan_karyawanGraph.php', 'post', 'proc=jbt-combo&karyID='+form.karyID.value, 
			function (res){ 
				form.dep_div_jabID.set('html', form.karyID.value==''? '' : res);
				updateJabatanDetail(form);
				update_graph(form);
		});
	}

	function updateJabatanDetail(form){
		var sindex = form.dep_div_jabID.selectedIndex;
		if (sindex<0) {
			penilai_updateJabatanCombo(form);	//biar waktu refresh combo jabatan tidak kosong
			return;
		}
		form.departemen.value = $(form.dep_div_jabID.options[sindex]).get('departemen');
		form.divisi.value = $(form.dep_div_jabID.options[sindex]).get('divisi');
	}

	function update_graph(form){
		form = $(form);
		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		
		form.proc.value="graph";
		$(form).set('send', {
			onSuccess: function(response) {
				$('graphIndicator').get('reveal').dissolve();
				$('graphContainer').set('html', response);
			}
		}).send();
	}

	function changePassword($karyID){
		FBModal_show2( 'proc/client/dataUser.php', 'post', "proc=change-password&karyID="+$karyID, true, true);
	}

	function savePassword(form){
		FBModal_loading("Save", "Please wait...", true, false);
		form.opass.value = hex_md5(form.opass.value).toLowerCase();
		form.npass.value = hex_md5(form.npass.value).toLowerCase();
		form.npass2.value = hex_md5(form.npass2.value).toLowerCase();
		$(form).set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true,1500);
			}
		}).send();
	}
	
	window.addEvent('domready', function(){
		updateJabatanCombo(document.frmSearch);
		update_periodeCombo(document.frmSearch);
	});
</script>
<?php } ?>

<?php include 'view/header.php'; ?>
<form name="frmSearch" action="proc/admin/laporan_karyawanGraph.php" method="post">
<input name="proc" type="hidden" value="" />
<input name="karyID" type="hidden" value="<?=$_COOKIE_DATA->username?>" />
<table width="100%" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="100">Periode</td>
    <td>
		<select name="periodeStart" onchange="update_periodeCombo($(this).getParent('form'))" class="marginR5">
		<?php $periodeStart = false; ?>
		<?php $PERIODE = periode_select(); ?>
		<?php $periodeCount = mysql_affected_rows() ?>
		<?php for ($i=0; $i<$periodeCount-1; $i++):?>
		<?php		$row = mysql_fetch_assoc($PERIODE); ?>
		<?php		$periodeStart= $periodeStart===false? $row['ID_PERIODE'] : $periodeAwal; ?>
			<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
		<?php endfor; ?>
		</select> <span> - </span>
		<select name="periodeEnd" class="marginL5" onchange="update_graph($(this).getParent('form'))"></select>
	</td>
  </tr>
  <tr>
    <td>Jabatan : </td>
    <td><select name="dep_div_jabID" onchange="updateJabatanDetail($(this).getParent('form')); update_graph($(this).getParent('form'))"></select></td>
  </tr>
  <tr>
    <td>Departemen : </td>
    <td><input type="text" name="departemen" class="fake" disabled="disabled" style="width:200px" /></td>
  </tr>
  <tr>
    <td>Divisi : </td>
    <td><input type="text" name="divisi" class="fake" disabled="disabled" style="width:200px" /></td>
  </tr>
</table>
<table width="100%" border="1">
</table>
</form>
<div class="padT10"></div>
<div>
	<div id="graphIndicator" style="padding:10px 0; margin:auto; display:none" align="center">
	<table width="200px">
	<tbody>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;">Rendering Image...</h3></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div id="graphContainer" align="center"></div>
</div>
<?php include 'view/footer.php'; ?>