<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/golongan/golongan.php' -->
<script>
	//add ke golongan table
	function golongan_add(){
		FBModal_show2( 'proc/golongan.php', 'post', "proc=add-modal", true, true);
	}

	//edit golongan table
	//@param id (string) kode/id golongan 
	function golongan_edit(id){
		FBModal_show2( 'proc/golongan.php', 'post', "proc=edit-modal&gol_id="+id, 
					true, true);
	}
	
	//delete golongan
	//@param id (string) kode/id golongan 
	function golongan_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/golongan.php', 'post', 'proc=golongan-delete&gol_id='+id, 
			null,
			function(res){
				//update tablenya
				golongan_updateList();
				
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Delete';
				
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true);
			});
	}

	//update table
	function golongan_updateList(key){
		key = key==null? "" : key;
		doRequest('proc/golongan.php', 'post', 'proc=golongan-table&key='+key, 
			function (res){ 
				$('golongan-table').innerHTML = res;
		});
	}

	//save golongan
	function golongan_save(form, type){
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
					true, true);

				golongan_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		golongan_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/golongan/gol.php';
include 'view/footer.php';