<?php

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/kriteriaPenilaian/kripen.php' -->
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	//add kriteria table
	function kripen_add(){
		FBModal_show2( 'proc/kriteriaPenilaian.php', 'post', "proc=add-modal", true, true, null);
	}

	//edit kriteria
	//@param id (string) kode/id divisi 
	function kripen_edit(id){
		doRequest('proc/kriteriaPenilaian.php', 'post', "proc=edit-modal&kripenID="+id, 
				null,
				function(res){
					var js = JSON.decode(res);
					if (js.error==true){
						FBModal_show(
							"<h2 class=\"dialog_title\"><span>Error</span></h2>" + 
							"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>", 
							true, true, 1500);
					}
					else{ FBModal_show( res, true, true); }
				});
	}
	
	//delete kriteria
	//@param id (string) kode/id divisi 
	function kripen_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/kriteriaPenilaian.php', 'post', 'proc=kripen-delete&kripenID='+id, 
			null,
			function(res){
				//update tablenya
				kripen_updateList();
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Delete';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);
			});
	}

	//update table
	function kripen_updateList(key){
		key = key==null? "" : key;
		doRequest('proc/kriteriaPenilaian.php', 'post', 'proc=kripen-table&key='+key, 
			function (res){ 
//				alert(res);
				$('kripen-table').innerHTML = res;
		});
	}

	//save divisi
	function kripen_save(form){
		FBModal_loading("Save", "Please wait...", false, false);
		$(form).set('send', {
			onSuccess: function(response) { 
//				alert(response); return;
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true, 1500);

				kripen_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		kripen_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/kriteriaPenilaian/kripen.php'; 
include 'view/footer.php';