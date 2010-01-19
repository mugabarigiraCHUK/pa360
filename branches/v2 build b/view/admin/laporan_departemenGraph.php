<?php
function inject_head(){?>
<script>
	function update_graph(form){
		form = $(form);
		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		
		form.proc.value="graph";
		$(form).set('send', {
			onSuccess: function(response) {
				$('graphIndicator').get('reveal').dissolve();
				$('graphContainer').set('html',response);
			}
		}).send();
	}

	window.addEvent('domready', function(){
		update_graph(document.frmSearch);
	});
</script><?php
}
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';
include_once 'model/departemen.php';

include 'view/header.php';
include 'view/admin/laporan_departemenGraph/departemenGraph.php';
include 'view/footer.php';