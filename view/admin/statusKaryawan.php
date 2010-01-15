<?php

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/statusKaryawan/stskary.php' -->
<script>
	//add ke divisi table
	function stskary_add(){
		FBModal_show2( 'proc/statusKaryawan.php', 'post', "proc=add-modal", true, true);
	}

	//edit divisi table
	//@param id (string) kode/id divisi 
	function stskary_edit(id){
		FBModal_show2( 'proc/statusKaryawan.php', 'post', "proc=edit-modal&stsID="+id, 
					true, true);
	}
	
	//delete divisi
	//@param id (string) kode/id divisi 
	function stskary_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/statusKaryawan.php', 'post', 'proc=stskary-delete&stsID='+id, 
			null,
			function(res){
				//update tablenya
				stskary_updateList();
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
	function stskary_updateList(key){
		key = key==null? "" : key;
		doRequest('proc/statusKaryawan.php', 'post', 'proc=stskary-table&key='+key, 
			function (res){ 
//				alert(res);
				$('stskary-table').innerHTML = res;
		});
	}

	//save divisi
	function stskary_save(form){
		FBModal_loading("Save", "Please wait...", false, false);
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

				stskary_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		stskary_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/statusKaryawan/stskary.php';
include 'view/footer.php';