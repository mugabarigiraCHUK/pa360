<?php 
function inject_head(){
?>
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
function jabatan_add(){
	//show the loading indicator
	FBModal_show2('proc/jabatan.php', 'post', "proc=add-modal", true, true, null,{
		onSuccess:function(res){
			$$('div.spinner').each(function(item){
				spinner_attach(item, item.getProperty('name'), item.getProperty('minVal'), 
								null, item.getProperty('currentVal'));
			});
		}
	});
}

/**
 * show jabatan dialog
 */
function jabatan_edit(jbtID){
	//show the loading indicator
	FBModal_show2('proc/jabatan.php','post',"proc=edit-modal&jbt_id="+jbtID, true, true, null,{
		onSuccess:function(res){
			$$('div.spinner').each(function(item){
				spinner_attach(item, item.getProperty('name'), item.getProperty('minVal'), 
								null, item.getProperty('currentVal'));
			});
		}
	});
}

function jabatan_save(form){
	var frm = $(form);
	frm.set('send', {
		onSuccess: function(response) { 
			var js = JSON.decode(response);
			var msg = js.error? js.msg : "Prosess simpan selesai !!!";
			var title = js.error? 'Error' : 'Add Jabatan';
			FBModal_show(
				"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
				"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>");
			FBModal_installFocusEvent();
			FBModal_installKeyEvent();

			//update list table-nya
			jabatan_updateList();
		}
	}).send();
}

/**
 * update jabatan
 * @param jbtID (string) - kode jabatan
 */
function jabatan_update(form){
	var frm = $(form);
	frm.set('send', {
		onSuccess: function(response) { 
			var js = JSON.decode(response);
			var msg = js.error? js.msg : "Prosess simpan selesai !!!";
			var title = js.error? 'Error' : 'Edit Jabatan';
			FBModal_show(
				"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
				"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>");
			FBModal_installFocusEvent();
			FBModal_installKeyEvent();

			//update list table-nya
			jabatan_updateList();
		}
	}).send();
}

/**
 * hapus jabatan
 * @param jbtID (string) - kode jabatan
 */
function jabatan_delete(jbtID){
	FBModal_show2(
		'lib/utils/fbModal.php', 
		'post', 
		"modalType=indicator_loading&title=Loading&msg=Please wait...",
		true);

	new Request({
		url: 'proc/jabatan.php',
		method: 'post',
		onSuccess: function (res){
			var js = JSON.decode(res);
			var msg = js.error? js.msg : "Prosess penghapusan selesai !!!";
			var title = js.error? 'Error' : 'Delete Jabatan';
		
			jabatan_updateList();

			FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>");
			FBModal_installFocusEvent();
			FBModal_installKeyEvent();
		}	
	}).send('proc=jabatan-delete&jbt_id='+jbtID);
}

/**
 * update list pada table jabatan
 */
function jabatan_updateList(key){
	key = key==null? "" : key;
	new Request({
		url: 'proc/jabatan.php',
		method: 'post',
		onSuccess: function (res){
			$('jabatan-table').innerHTML = res;
		}	
	}).send('proc=jabatan-table-list&key='+key);
}

window.addEvent('domready', function(){
	jabatan_updateList();
});
</script>	
<?php 
}
 
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/jabatan.php';

include 'view/header.php';
include 'view/admin/jabatan/jabatan.php';
include 'view/footer.php';