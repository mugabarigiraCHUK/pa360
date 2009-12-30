<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/kriteriaPenilaian.php';

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/detilKriteriaPenilaian/dekripen.php' -->
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	//search detil kriteria table
	function dekripen_search(){
		FBModal_show2( 'proc/detilKriteriaPenilaian.php', 'post', "proc=search-modal", 
				true,true);
	}

	//add kriteria table
	function dekripen_add(){
		var kripenID = $('kripenID').value;
		FBModal_show2( 'proc/detilKriteriaPenilaian.php', 'post', "proc=add-modal&kripenID="+kripenID, 
				true, true, null,
				{onSuccess:	function (res){			//install spinner 
					var spinner = new DG.Spinner( {
//						el: $('bobotSpinner-el'),
						renderTo : 'bobotSpinner',
						name: 'bobot',
						increment:1,
						shiftIncrement:5,
						decimals:0,
						minValue:0,
						maxValue:100,
						value:0,
						disableWheel:true,
						disableArrowKeys:true,
						styles: {
							width:'30px', position:'relative', padding:'1px 0'
						}
					});
				}
		});
	}

	//edit kriteria
	//@param id (string) kode/id divisi 
	function dekripen_edit(id){
		FBModal_show2( 'proc/detilKriteriaPenilaian.php', 'post', "proc=edit-modal&dekripenID="+id, 
				true, true, null,
				{onSuccess:	function (res){			//install spinner 
					var spinner = new DG.Spinner( {
//						el: $('bobotSpinner-el'),
						renderTo : 'bobotSpinner',
						name: 'bobot',
						increment:1,
						shiftIncrement:5,
						decimals:0,
						minValue:0,
						maxValue:100,
						value:$('bobotSpinner').get('initVal'),
						disableWheel:true,
						disableArrowKeys:true,
						styles: {
							width:'30px', position:'relative', padding:'1px 0'
						}
					});
				}
		});
	}
	
	//delete kriteria
	//@param id (string) kode/id divisi 
	function dekripen_delete(id){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/detilKriteriaPenilaian.php', 'post', 'proc=dekripen-delete&dekripenID='+id, 
			null,
			function(res){
				//update tablenya
				dekripen_updateList();
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
	//@param id (string) - id kriteria 
	function dekripen_updateList(key){
		key = key==null? '' : key;
		var id = $('kripenID').value;
		doRequest('proc/detilKriteriaPenilaian.php', 'post', 
			'proc=dekripen-table&kripenID='+id+
			'&key='+key, 
			function (res){ 
				$('dekripen-table').innerHTML = res;
		});
	}

	//save divisi
	function dekripen_save(form){
		FBModal_loading("Save", "Please wait...", false, false);
		$(form).set('send', {
			onSuccess: function(response) { 
//				alert(response); //return;
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true, 1500);

				dekripen_updateList();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		dekripen_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/detilKriteriaPenilaian/dekripen.php'; 
include 'view/footer.php';