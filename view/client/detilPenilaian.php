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
		$(form).set('send', {
			onSuccess: function(response) {
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);
				setTimeout("location.replace(\"./dashboard.php?p=penilaian"+
						  "&periodeID="+form.periodeID.value+
						  "&dep_div_jabID="+form.dep_div_jabID.value+"\")",1500);
			}
		}).send();
	}
	
	window.addEvent('domready', function(){
		//BUG on spinner, saat element display=none, jadi visible-kan semua spinner pada tab dulu
		var tab = $$('div.tabs_panel')
		tab.each(function(item){ item.removeClass('tabs_panel'); });
		//attach spinner
		$$('div.spinner').each(function(item){
			spinner_attach(item, item.getProperty('name'), item.getProperty('minValue'), 
							item.getProperty('maxValue'), 1);
		});
		tab.each(function(item){ item.addClass('tabs_panel'); });

		//create tab-nya
		new tabbedPane('kriteriaTab');
	});
</script><?php
}

//cek karyawan yg dinilai, jika tidak ada, redirect ke halaman penilaian
if (!isset($_POST['karyID']) || $_POST['karyID']==='') header('Location: ./');

include 'view/header.php';
include 'view/client/detilPenilaian/detilPenilaian.php';
include 'view/footer.php';