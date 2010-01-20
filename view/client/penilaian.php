<?php
include_once 'lib/db.php';
include_once 'model/periode.php';
include_once 'model/karyawan-relasi.php';

function inject_head(){?> 
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	function jbt_comboEvent(combo){
		$('frmSearch').departemen.value = $(combo.options[combo.selectedIndex]).getProperty('departemen');
		$('frmSearch').divisi.value = $(combo.options[combo.selectedIndex]).getProperty('divisi');
	}

	function penilaian_updateTable(form){
		FBModal_loading("Loading", "Please wait...", true, false);
		$(form).set('send', {
			onSuccess: function(response) { 
				$('dinilai-table').set('html', response);
				FBModal_hide();
			}
		}).send();
	}
	
	window.addEvent('domready', function(){
		var form = document.frmSearch;

		//add event
		$(form).addEvent('submit', function(e){			//form event
			penilaian_updateTable(this);
		});
		form.periodeID.addEvent('change', function(e){	//combo periode
			form.fireEvent('submit');
		});
		form.dep_div_jabID.addEvent('change', function(e){	//combo dep_div_jab
			jbt_comboEvent(this);
			form.fireEvent('submit');
		});

		//onload event
		jbt_comboEvent($(document.frmSearch.dep_div_jabID));
		form.fireEvent('submit');
	});
</script><?php
}

include 'view/header.php';
include 'view/client/penilaian/penilaian.php';
include 'view/footer.php';