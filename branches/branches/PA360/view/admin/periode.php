<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?> 
<!-- UNTUK HALAMAN  'view/periode/period.php' -->
<link rel="stylesheet" type="text/css" href="css/datepicker_vista.css" />
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script type="text/javascript" src="jscript/datepicker.js"></script>
<script>
	//add ke periode table
	function periode_add(){
		FBModal_show2( 'proc/periode.php', 'post', "proc=add-modal", 
			true, false, null, {
				onSuccess: function(res){
					dtpicker_attach('.dtpick');
					spinner_attach('bobotV', 'bobotV');
					spinner_attach('bobotH', 'bobotH');
					spinner_attach('lvV', 'lvV');
					spinner_attach('lvH', 'lvH');
				}
		});
	}

	//edit periode table
	//@param id (string) kode/id periode 
	function periode_edit(id){
		FBModal_show2( 'proc/periode.php', 'post', "proc=edit-modal&periodeID="+id, 
				true, false, null, {
			onSuccess: function(res){
				dtpicker_attach('.dtpick');
				spinner_attach('bobotV', 'bobotV', 0, 100, $('bobotV').getProperty('spinnerValue'));
				spinner_attach('bobotH', 'bobotH', 0, 100, $('bobotH').getProperty('spinnerValue'));
				spinner_attach('lvV', 'lvV', 0, 100, $('lvV').getProperty('spinnerValue'));
				spinner_attach('lvH', 'lvH', 0, 100, $('lvH').getProperty('spinnerValue'));
			}
		});
	}
	
	//delete periode
	//@param id (string) kode/id periode 
	function periode_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/periode.php', 'post', 'proc=periode-delete&periodeID='+id, 
			null,
			function(res){
				//update tablenya
				periode_updateList();
				
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Delete';
				
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true,true,1500);
			});
	}

	//update table
	function periode_updateList(key){
		key = key==null? "" : key;
		doRequest('proc/periode.php', 'post', 'proc=periode-table&key='+key, 
			function (res){ 
				$('periode-table').innerHTML = res;
		});
	}

	//save periode
	function periode_save(form, type){
		FBModal_loading("Save", "Please wait...", true, false);
		$(form).set('send', {
			onSuccess: function(response) { 
//				alert(response);
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);

				periode_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		periode_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/periode/periode.php';
include 'view/footer.php';