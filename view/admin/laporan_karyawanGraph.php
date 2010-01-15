<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';

function inject_head(){?>
<script>
	function update_periodeCombo(form){
		FBModal_loading("Loading", "Please wait...", true, false);
		form.proc.value="periode-combo";
		form.periodeEnd.set('html', "");
		$(form).set('send', {
			onSuccess: function(response) {
				form.periodeEnd.set('html', response);
				update_graph(document.frmSearch);
				FBModal_hide();
			}
		}).send();
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
				update_graph(form)
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
	
	window.addEvent('domready', function(){
		update_periodeCombo(document.frmSearch);
		updateJabatanCombo(document.frmSearch);
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/laporan_karyawanGraph/karyawanGraph.php';
include 'view/footer.php';