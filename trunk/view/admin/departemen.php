<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/departemen/departemen.php' -->
<script>
	//add ke departemen table
	function departemen_add(){
		FBModal_show2( 'proc/departemen.php', 'post', "proc=add-modal", true, true);
	}

	//edit departemen table
	//@param id (string) kode/id departemen 
	function departemen_edit(id){
//		alert (id);
		FBModal_show2( 'proc/departemen.php', 'post', "proc=edit-modal&dep_id="+id, 
					true, true);
	}
	
	//delete departemen
	//@param id (string) kode/id departemen 
	function departemen_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/departemen.php', 'post', 'proc=departemen-delete&dep_id='+id, 
			null,
			function(res){
				//update tablenya
				departemen_updateList();
				
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
	function departemen_updateList(key){
		key = key ==null? "" : key;
		doRequest('proc/departemen.php', 'post', 'proc=departemen-table&key='+key, 
			function (res){ 
//				alert(res);
				$('departemen-table').innerHTML = res;
		});
	}

	//save departemen
	function departemen_save(form, type){
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

				departemen_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		departemen_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/departemen/dep.php';
include 'view/footer.php';