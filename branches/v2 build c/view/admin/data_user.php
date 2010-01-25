<?php
function inject_head(){?> 
<script type="text/javascript" src="jscript/md5.js"></script>
<script>
	//@key (string) - search key
	function updateList(key){
		if (key==null) key = "";
		doRequest('proc/admin/dataUser.php', 'post', 'proc=kary-table&key='+key, 
			function (res){ 
				$$('.asAdmin').destroy();
				
				$('kary-table').innerHTML = res;
				$$('.asAdmin').addEvent('change', function(){
					saveRole(this.getProperty('karyID'), this);
				});
		});
	}

	function saveRole(karyID, checkbox){
		doRequest('proc/admin/dataUser.php', 'post', 'proc=change-role-save'+
				'&karyID='+karyID+'&state='+(checkbox.checked?1:0), 
			function(response){
				var js = JSON.decode(response);
				if (js.error){
					FBModal_show(
						"<h2 class=\"dialog_title\"><span>Error</span></h2>" + 
						"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>",
						true, true,1500);
				}
			});
	}
	
	function changePassword($karyID){
		FBModal_show2( 'proc/admin/dataUser.php', 'post', "proc=change-password&karyID="+$karyID, true, true);
	}
	
	function savePassword(form){
		FBModal_loading("Save", "Please wait...", true, false);
		form.npass.value = hex_md5(form.npass.value).toLowerCase();
		form.npass2.value = hex_md5(form.npass2.value).toLowerCase();
		$(form).set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true,1500);
			}
		}).send();
	}
	
	window.addEvent('domready', function(){
		updateList(document.frmSearch.key.value);
	});
</script><?php
}

include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/karyawan.php';

include 'view/header.php';
include 'view/admin/dataUser/user.php';
include 'view/footer.php';