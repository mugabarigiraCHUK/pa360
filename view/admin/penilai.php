<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'model/karyawan.php';
include_once 'model/periode.php';
include_once 'model/bobotLevel.php';
include_once 'model/departemen.php';

function inject_head(){?>
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<script type="text/javascript" src="jscript/tabs.js"></script>
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
		var form = $('frmPenilai');
		form.searchKey.value = karyNama;
		form.karyID.value = karyID;
		penilai_updateJabatanCombo($('frmPenilai'));
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
					//form.level.value = form.stsPenilaian.options[0].get('level'); 
			});
	}

	function penilai_updateLevelText(form, text){
		form.level.value = text;
	}

	var oldKaryID = null;
	function penilai_updateTable(form){
		penilai_updateJabatanDetail(form);

		//update table
		form.proc.value = 'kary-dinilai-table';
		form.set('send', {
			onSuccess: function(response) {
				//destroy old table
				$$('.kary-dinilai-table-checkbox').each(function(item){ item.destroy(); });
				
				$('kary-dinilai-table').set('html', response);
				$$('.kary-dinilai-table-checkbox').addEvent('change', function(){ penilai_save(this); });
			}
		}).send();
		doRequest('proc/penilai.php', 'post', 
				'proc=kary-dinilai-table-konflik'+
				'&karyID='+form.karyID.value+
				'&dep_div_jabID='+form.dep_div_jabID.value+
				'&periodeID='+form.periodeID.value+
				'&stsPenilaian='+form.stsPenilaian.value+
				'&departemenID='+form.departemenID.value,
			function (response){ 
				$('kary-dinilai-konflik-table').set('html', response);
			}
		);
	}

	function penilai_save(item){
		var form = item.getParent('form');
		doRequest('proc/penilai.php', 'post', 
			'proc=penilai-save'+
			'&dinilaiID='+item.getProperty('karyID')+
			'&dinilai_dep_div_jabID='+item.getProperty('dep_div_jabID')+
			'&periodeID='+form.periodeID.value+
			'&levelID='+form.stsPenilaian.value+
			'&penilaiID='+form.karyID.value+
			'&penilai_dep_div_jabID='+form.dep_div_jabID.value+
			'&state='+(item.checked? 1 : 0),
				function (res){ 
					var js = JSON.decode(res);
					if (js.error){
						var title ='Error';
						FBModal_show(
							"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
							"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>", 
							true, true, 1500);
					}

//					penilai_updateTable(form);
			});
	}

	var oldContent;
	window.addEvent('domready',function(e) { 
		penilai_updateTable($('frmPenilai'), e);
		penilai_updateLevel($('frmPenilai'));
		new tabbedPane('kriteriaTab');
	});

	function getTabbedpaneState(){
		var tabState=false;
		$$('div.tabs_panel').each(function(item){
			if (item.hasClass('active')) tabState=$(item.id);
		});
		return tabState;
	}
</script>
<?php }

include 'view/header.php';
include 'view/admin/penilai/penilai.php';
include 'view/footer.php';