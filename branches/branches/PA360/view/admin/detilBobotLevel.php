<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include 'model/periode.php';
include 'model/bobotLevel.php';
include 'model/kriteriaPenilaian.php';

function inject_head(){?> 
<script>
	function debotlv_add(periodeID, levelID){
		var periodeID = $('periodeID').value;
		var levelID = $('levelID').value;
		FBModal_show2( 'proc/detilBobotLevel.php', 'post', "proc=add-modal"+
				"&periodeID="+periodeID+"&levelID="+levelID,
			true, false, null);
	}

	function debotlv_delete(periodeID, levelID, kripenID){
		doRequest('proc/detilBobotLevel.php', 'post', 'proc=debotlv-delete'+
			'&periodeID='+periodeID+'&levelID='+levelID+'&kripenID='+kripenID, 
			function (res){ 
				debotlv_updateList(null);
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Delete';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true, 1500); 
			});
	}

	function debotlv_saveKriteria(periodeID, levelID, kripenID){
		$('kripen-table').set('html',"<tr><td align=\"center\" colspan=\"4\"><div class=\"indicator\"><h3 style=\"padding-top:10px;\"><span style=\"margin-left:40px;\">Saving...</span></h3></div></td>");
		doRequest('proc/detilBobotLevel.php', 'post', 'proc=debotlv-save'+
			'&periodeID='+periodeID+'&levelID='+levelID+'&kripenID='+kripenID, 
			function (res){
				debotlv_updateList(null);
				var js = JSON.decode(res);
				if (! js.error) { debotlv_updateKriteriaList(periodeID,levelID); }
				else {
					 $('kripen-table').set('html',"<tr><td align=\"center\" colspan=\"4\"><h3 style=\"padding-top:10px;\">"+js.msg+"</h3></td>");

					//update the kriteria list
					setTimeout("debotlv_updateKriteriaList('"+periodeID+"','"+levelID+"');",1500);
				}
			});
	}
	
	//update table
	function debotlv_updateList(key){
		key = key==null? "" : key;
		var periodeID = $('periodeID').value;
		var levelID = $('levelID').value;
		doRequest('proc/detilBobotLevel.php', 'post', 'proc=debotlv-table'+
			'&periodeID='+periodeID+'&levelID='+levelID+'&key='+key, 
			function (res){ 
				$('debotlv-table').set('html',res);
			});
	}

	function debotlv_updateComboBobotLevel(periodeID){
		doRequest('proc/detilBobotLevel.php', 'post', 'proc=debotlv-comboBobotLevel'+
				'&periodeID='+periodeID, 
				function (res){ 
					$('levelID').set('html', res);
					debotlv_updateList();
				});
	}

	function debotlv_updateKriteriaList(periodeID, levelID){
		doRequest('proc/detilBobotLevel.php', 'post', 'proc=debotlv-kripen-table'+
				'&periodeID='+periodeID+'&levelID='+levelID, 
				function (res){ $('kripen-table').set('html',res); });
	}
	
	window.addEvent('domready', function(){
		debotlv_updateList();
		debotlv_updateComboBobotLevel($('periodeID').value);
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/detilBobotLevel/debotlv.php';
include 'view/footer.php';