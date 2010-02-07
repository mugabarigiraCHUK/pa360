<?php
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';

function inject_head(){?>
<script>
	function update_periodeCombo(form){
		FBModal_loading("Loading", "Please wait...", true, false);
		form.proc.value="periode-combo";
		form.periodeEnd.set('html', "");
		$(form).set('send', {
			onSuccess: function(response) {
				form.periodeEnd.set('html', response);
				update_graph(document.frmSearch);
				FBModal_hide();
			}
		}).send();
	}

	function update_graph(form){
		form = $(form);

		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		
		var oldreq = form.retrieve('request');
		if ($defined(oldreq)) oldreq.cancel();
		
		var req = doRequest('proc/admin/laporan_periodeGraph.php', 'post', 
			'proc=graph&periodeStart='+form.periodeStart.value+ 
			'&periodeEnd='+form.periodeEnd.value, null, 
			function(res){
				$('graphIndicator').get('reveal').dissolve();
				$('graphContainer').set('html', res);
			});
		form.store('request', req);
	}

	function drill(){
		var form = document.frmSearch;
		var start = form.periodeStart.value;
		var end = form.periodeEnd.value;
		FBModal_loading("Loading", "Please wait...", true, false);
		FBModal_show2( 
			'proc/admin/laporan_periodeGraph.php', 'post', 
			"proc=drill&periodeStart="+start+"&periodeEnd="+end, 
			true, false, null, {
				onSuccess: function(res){
					drill_table($(document.frmModal));
				}
			});
	}

	function drill_table(form){
		$('drill-table').set('html',"<tr><td align=\"center\" colspan=\"4\"><div class=\"indicator\"><h3 style=\"padding-top:10px;\"><span style=\"margin-left:40px;\">Loading...</span></h3></div></td>");
		form.proc.value="drill-table";
		$(form).set('send', {
			onSuccess: function(response) {
				$('drill-table').set('html',response);
			}
		}).send();
	}
	window.addEvent('domready', function(){
		update_periodeCombo(document.frmSearch);
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/laporan_periodeGraph/periodeGraph.php';
include 'view/footer.php';