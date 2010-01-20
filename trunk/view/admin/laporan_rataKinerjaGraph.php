<?php

function inject_head(){?>
<script>
	function update_periodeCombo(form){
//		FBModal_loading("Loading", "Please wait...", true, false);
		form.proc.value="periode-combo";
		form.periodeEnd.set('html', "");
		$(form).set('send', {
			onSuccess: function(response) {
				form.periodeEnd.set('html', response);
				update_graph(form);
//				FBModal_hide();
			}
		}).send();
	}

	function update_graph(form){
		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		form.proc.value="graph";
		$(form).set('send', {
			onSuccess: function(response) {
				$('graphContainer').set('html', response);
				$('graphIndicator').get('reveal').dissolve();
			}
		}).send();
	}

	window.addEvent('domready', function(){
		update_periodeCombo(document.frmSearch);
	});
</script><?php
}
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';

include 'view/header.php';
include 'view/admin/laporan_rataKinerjaGraph/rataKinerja.php';
include 'view/footer.php';