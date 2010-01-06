<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/kriteriaPenilaian.php';
include 'model/detilKriteriaPenilaian.php';

function inject_head(){?>
<!-- UNTUK HALAMAN  'view/detilKriteriaPenilaian/dekripen.php' -->
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	//search detil kriteria table
	function debot_search(){
		var dekripen = $('dekripenID').value;
		FBModal_show2( 'proc/detilKriteriaPenilaian.php', 'post', 
				"proc=debot-table&nilai="+ nilai +"&dekripenID="+ dekripen +"&key=", true, true);
	}

	//add kriteria table
	function debot_add(){
		var kripenID = $('kripenID').value;
		var dekripenID = $('dekripenID').value;
		FBModal_show2( 'proc/deskripsiBobot.php', 'post', 
				"proc=add-modal&kripenID="+kripenID+"&dekripenID="+dekripenID, 
				true, true, null,
				{onSuccess:	function (res){			//install spinner 
					var spinner = new DG.Spinner( {
						renderTo : 'nilaiSpinner',
						name: 'nilai',
						increment:1,
						shiftIncrement:5,
						decimals:0,
						minValue:0,
						maxValue:10,
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
	function debot_edit(nilai, dekripen){
		FBModal_show2( 'proc/deskripsiBobot.php', 'post', "proc=edit-modal&nilai="+nilai+"&dekripenID="+dekripen, 
				true, true);
	}
	
	//delete kriteria 
	function debot_delete(nilai, dekripenID){
		FBModal_loading("Delete", "Please wait...", false, false);
		doRequest('proc/deskripsiBobot.php', 'post', 'proc=debot-delete&nilai='+nilai+'&dekripenID='+dekripenID, 
			null,
			function(res){
				//update tablenya
				debot_updateList();
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Delete';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);
			});
	}

	//save divisi
	function debot_save(form){
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

				debot_updateList();
			}
		}).send();
	}

	//update table
	function debot_updateList(key){
		key = key==null? "" : key;
		var kripen = $('kripenID').value;
		var dekripen = $('dekripenID').value;
		doRequest('proc/deskripsiBobot.php', 'post', 
				'proc=debot-table&key='+key+'&dekripenID='+dekripen, 
			function (res){ 
				$('debot-table').innerHTML = res;
		});
	}
	
	function debot_updateDekripen(){
		var id = $('kripenID').value;
		doRequest('proc/deskripsiBobot.php', 'post', 'proc=debot-dekripenCombo&kripenID='+id, 
				function (res){ 
//					alert(res);
					$('dekripenID').innerHTML = res;
					debot_updateList();
		});
	}

	window.addEvent('domready', function(){
		debot_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/deskripsiBobot/debot.php'; 
include 'view/footer.php';