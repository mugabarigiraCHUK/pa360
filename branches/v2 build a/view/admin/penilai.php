<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/karyawan.php';
include 'model/periode.php';

function inject_head(){?>
<script>
	//search karyawan
	function penilai_searchKary_modal(){
		FBModal_show2('proc/penilai.php','post', "proc=searchKary-modal", true, true);
	}

	function penilai_searchKary_updateTable(form){
		form.set('send', {
			onSuccess: function(response) {
				$('searchKary-table').set('html', response);
			}
		}).send();
	}
	
	function penilai_searchKary_pick(karyID, karyNama){
		FBModal_hide();
		var form = $('frmSearch');
		form.searchKey.value = karyNama;
		form.karyID.value = karyID;
		penilai_updateJabatanCombo($('frmSearch'));
	}

	function penilai_searchKary_modal2(){
		//simpan sementara 
		oldContent = FBModal_getContent();

		//kita gunakan frmSearch sebagai dasar datanya
		form = $('frmSearch');
		form.proc.value = 'searchKary2-modal';
		form.set('send', {
			onSuccess: function(response) { 
				FBModal_show(response, true);
			}
		}).send();
	}

	function penilai_searchKary_updateTable2(form){
		form.set('send', {
			onSuccess: function(response) {
				$('searchKary2-table').set('html', response);
			}
		}).send();
	}

	function penilai_searchKary_pick2(karyID, karyNama, dep_div_jabID, jabatanNama, departemenNama, divisiNama){
		FBModal_show(oldContent, true);
		var form = $('frmModal');
		form.penilai.value = karyNama;
		form.penilaiID.value = karyID;
		form.dep_div_jabPenilaiID.value = dep_div_jabID;
		$('jabatanNama').set('html', jabatanNama);
		$('departemenNama').set('html', departemenNama);
		$('divisiNama').set('html', divisiNama);
	}

	function penilai_updateJabatanCombo(form){
		if (form.karyID.value=='') { return; }
		doRequest('proc/penilai.php', 'post', 'proc=jbt-combo&karyID='+form.karyID.value, 
			function (res){ 
				form.dep_div_jabID.set('html', form.karyID.value==''? '' : res);
				penilai_updateTable(form);
		});
	}

	function penilai_updateJabatanDetail(form){
		var sindex = form.dep_div_jabID.selectedIndex;
		if (sindex<0) {
			penilai_updateJabatanCombo(form);	//biar waktu refresh combo jabatan tidak kosong
			return;
		}
		form.departemen.value = $(form.dep_div_jabID.options[sindex]).get('departemen');
		form.divisi.value = $(form.dep_div_jabID.options[sindex]).get('divisi');
	}

	function penilai_updateLevel(form){
		doRequest('proc/penilai.php', 'post', 'proc=level-depth&periodeID='+form.periodeID.value, 
				function (res){ 
					form.stsPenilaian.set('html', res);
					form.level.value = form.stsPenilaian.options[0].get('level'); 
			});
	}

	function penilai_updateLevelText(form, text){
		form.level.value = text;
	}

	var oldKaryID = null;
	function penilai_updateTable(form){
		penilai_updateJabatanDetail(form);
		
		//update table
		form.proc.value = 'penilai-table';
		form.set('send', {
			onSuccess: function(response) {
				$('penilai-table').set('html', response);
			}
		}).send();
		
		//FBModal_loading("Validating", "Please wait...", false, false);
	}

	function penilai_add(form){
		form.proc.value = 'add-modal';
		form.set('send', {
			onSuccess: function(response) { 
				FBModal_show(response);
			}
		}).send();
	}

	function penilai_delete(nilaiPerPenilaiID){
		FBModal_loading("Delete", "Please wait...", true, false);
		doRequest('proc/penilai.php', 'post', 'proc=penilai-delete&nilaiPerPenilaiID='+nilaiPerPenilaiID, 
				function (res){ 
					var js = JSON.decode(res);
					var msg = js.error? js.msg : "Process penghapusan selesai !!!";
					var title = js.error? 'Error' : 'Deleteing';
					FBModal_show(
						"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
						"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
						true, true, 1500);
					penilai_updateTable($('frmSearch'));
			});
	}

	function penilai_save(form){
		form.proc.value = 'penilai-save';
		form.set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true, 1500);
				penilai_updateTable($('frmSearch'));
			}
		}).send();
	}

	var oldContent;
	window.addEvent('domready',function(e) { 
		penilai_updateTable($('frmSearch'), e);
		penilai_updateLevel($('frmSearch'));
	});
</script>
<?php }

include 'view/header.php';
include 'view/admin/penilai/penilai.php';
include 'view/footer.php';