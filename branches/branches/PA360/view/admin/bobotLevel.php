<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';

function inject_head(){?> 
<link rel="stylesheet" type="text/css" href="css/Spinner.css" />
<script type="text/javascript" src="jscript/Spinner.js"></script>
<script>
	function bobotLevel_edit(periodeID, levelID){
		FBModal_loading("Loading", "Please wait...", true, false);
		FBModal_show2( 'proc/bobotLevel.php', 'post', "proc=edit-modal"+
				"&periodeID="+periodeID+"&levelID="+levelID,
			true, false, null, {
			onSuccess: function(res){
				spinner_attach('bobot', 'bobot', 0, 100, $('bobot').getProperty('spinnerValue'));
			}
		});
	}

//	function bobotLevel_kriteria(periodeID, levelID){
//		FBModal_show2( 'proc/bobotLevel.php', 'post', "proc=kriteria-modal"+
//				"&periodeID="+periodeID+"&levelID="+levelID, true, true);
//	}

//	function bobotLevel_pickKriteria(){
//		
//	}

	function bobotLevel_save(form){
		FBModal_loading("Save", "Please wait...", true, false);
		$(form).set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>", 
					true, true, 1500);

				bobotLevel_updateList();
			}
		}).send();
	}
	
	//update table
	function bobotLevel_updateList(key){
		key = key==null? "" : key;
		var periodeID = $('periodeID').value;
		doRequest('proc/bobotLevel.php', 'post', 'proc=bobotLevel-table'+
			'&periodeID='+periodeID+'&key='+key, 
			function (res){ 
				$('bobotlv-table').innerHTML = res;
			});
	}

//	function bobotLevel_kriteriaUpdateList(key){
//		key = key==null? "" : key;
//		doRequest('proc/bobotLevel.php', 'post', 'proc=kriteria-table&key='+key, 
//			function (res){ 
//				$('kriteria-table').innerHTML = res;
//			});
//	}

//	function bobotLevel_chooseKriteria_balancing(el){
//		
//	}
	
	window.addEvent('domready', function(){
		bobotLevel_updateList();
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/bobotLevel/bobotlv.php';
include 'view/footer.php';