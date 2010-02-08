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

	function drill(){
		var form = document.frmSearch;
		form.proc.value = "drill";
		FBModal_loading("Loading", "Please wait...", true, false);
		$(form).set('send', {
			onSuccess: function(response) {
				FBModal_show(response, true, true, null);
				drill_table(document.frmModal);
			}
		}).send();
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