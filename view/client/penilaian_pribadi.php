<?php
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';
include_once 'model/karyawan.php';
include_once 'model/detilBobotLevel.php';
include_once 'model/detilKriteriaPenilaian.php';
include_once 'model/deskripsiBobot.php';

function inject_head(){?> 
<link rel="stylesheet" type="text/css" href="css/tabs.css" />
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/tabs.js"></script>
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	function detil_save(form){
		FBModal_loading("Save", "Please wait...", true, false);
		form.proc.value = "2";
		$(form).set('send', {
			onSuccess: function(response) {
				/* debug */
				alert(response);
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);
				setTimeout("location.replace(\"./dashboard.php\")",1500);
			}
		}).send();
	}

	function jabatanCombo(form){
		if (form.karyID.value=='') { return; }
		doRequest('proc/client/penilaian_pribadi.php', 'post', 'proc=0&karyID='+form.karyID.value, 
			function (res){
				form.dep_div_jabID.set('html', form.karyID.value==''? '' : res);
				jabatanCombo_change(form);
		});
	}

	function jabatanCombo_change(form){
		form.departemen.value = form.dep_div_jabID.options[form.dep_div_jabID.selectedIndex].getProperty("departemen");
		form.divisi.value = form.dep_div_jabID.options[form.dep_div_jabID.selectedIndex].getProperty("divisi");
	}

	function kriteria(form){
		FBModal_loading("Save", "Please wait...", true, false);
		$(form).proc.value = '1';
		$(form).set('send', {
			onSuccess: function(response) {
				/* debug */
				//alert(response);
				$('kripen-tab').set('html',response);

				//BUG on spinner, saat element display=none, jadi visible-kan semua spinner pada tab dulu
				var tab = $$('div.tabs_panel');
				tab.each(function(item){ item.removeClass('tabs_panel'); });
				//attach spinner
				$$('div.spinner').each(function(item){
					spinner_attach(item, item.getProperty('name'), item.getProperty('minValue'), 
									item.getProperty('maxValue'), 1);
				});
				tab.each(function(item){ item.addClass('tabs_panel'); });

				//create tab-nya
				new tabbedPane('kriteriaTab');
				FBModal_hide();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		jabatanCombo(document.forms[0]);
		kriteria(document.forms[0]);
	});
</script><?php
}

include 'view/header.php';
include 'view/client/penilaian_pribadi/pribadi.php';
include 'view/footer.php';