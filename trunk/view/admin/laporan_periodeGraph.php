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
		var end = form.periodeEnd.value == "-1"? false : form.periodeEnd.value;
		var periodeTitle =  start+ (!end? "" : ' s/d '+end); 
		FBModal_show2( 'proc/admin/laporan_periodeGraph.php', 'post', 
				"proc=drill&periodeTitle="+periodeTitle, true, false, null);
	}

	window.addEvent('domready', function(){
		update_periodeCombo(document.frmSearch);
	});
</script><?php
}

include 'view/header.php';
include 'view/admin/laporan_periodeGraph/periodeGraph.php';
include 'view/footer.php';