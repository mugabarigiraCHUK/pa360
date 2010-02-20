<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?>
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	function add(){
		var periodeID = document.frmSearch.periodeID.value;
		FBModal_show2( 'proc/admin/grade.php', 'post', "proc=1&periodeID="+periodeID, true, true, null, {
			onSuccess: function(ex){
				spinner_attach($('min'), "min", 0, 10, 0, .1, 1);
				spinner_attach($('max'), "max", 0, 10, 0, .1, 1);
			}
		});
	}

	function save(form){
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

				update_table(document.frmSearch);
			}
		}).send();
	}

	function edit(gradeID){
		FBModal_show2( 'proc/admin/grade.php', 'post', "proc=2&gradeID="+gradeID, true, true, null, {
			onSuccess: function(ex){
				spinner_attach($('min'), "min", 0, 10, $('min').getProperty('spinnerValue'), .1, 1);
				spinner_attach($('max'), "max", 0, 10, $('max').getProperty('spinnerValue'), .1, 1);
			}
		});
	}

	function remove(gradeID, el){
		doRequest('proc/admin/grade.php', 'post', 'proc=3&gradeID='+gradeID, 
			function (response){ 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process penghapusan berhasil !!!";
				var title = js.error? 'Error' : 'Delete';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true, 1500);
				update_table(document.frmSearch);
		});
	}

	function update_table(form){
		var periodeID = form.periodeID.value;
		doRequest('proc/admin/grade.php', 'post', 'proc=0&periodeID='+periodeID, 
			function (res){ 
				$('grade-table').innerHTML = res;
		});
	}
	
	window.addEvent('domready', function(){
		update_table(document.frmSearch);
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/grade/grade.php';
include 'view/footer.php';