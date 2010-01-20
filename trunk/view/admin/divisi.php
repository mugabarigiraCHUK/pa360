<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/divisi/divisi.php' -->
<script>
	//add ke divisi table
	function divisi_add(){
		FBModal_show2( 'proc/divisi.php', 'post', "proc=add-modal", true, true);
	}

	//edit divisi table
	//@param id (string) kode/id divisi 
	function divisi_edit(id){
		FBModal_show2( 'proc/divisi.php', 'post', "proc=edit-modal&divID="+id, 
					true, true);
	}
	
	//delete divisi
	//@param id (string) kode/id divisi 
	function divisi_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/divisi.php', 'post', 'proc=divisi-delete&divID='+id, 
			null,
			function(res){
				//update tablenya
				divisi_updateList();
				
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
	function divisi_updateList(key){
		key = key==null? "" : key;
		doRequest('proc/divisi.php', 'post', 'proc=divisi-table&key='+key, 
			function (res){ 
				$('divisi-table').innerHTML = res;
		});
	}

	//save divisi
	function divisi_save(form, type){
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

				divisi_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		divisi_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/divisi/divisi.php';
include 'view/footer.php';