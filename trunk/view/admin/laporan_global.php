<?php 
function inject_head(){?>
<script>
<?php if ($_REQUEST['sub']==='printable'):?>
window.addEvent('domready', function(){
	window.print();
});

<?php else: ?>
function search_updateTable(form){
	FBModal_loading("Save", "Please wait...", true, false);
	$(form).set('send', {
		onSuccess: function(response) { 
			$('search-table').set('html', response);
			FBModal_hide();
		}
	}).send();
}

function dep_updateLabel(el){
	var text = $(el.options[el.selectedIndex]).get('html');
	if (el.value=='false' || el.value=='') {
		$('depAvgLabelContainer').get('reveal').dissolve();
	}
	else{
		var proc= 'proc=departemen-avg'+
					'&periodeID='+document.frmSearch.periodeID.value+
					'&departemenID='+document.frmSearch.departemenID.value;
		doRequest('proc/admin/laporan_global.php', 'post', proc, null,
			function(res){
				$('depAvgLabel').set('value', res);
				$('depAvgLabelContainer').get('reveal').reveal();
			});
	}
	$('depAvgCaption').set('html', text);
}

function show_detil(form){
	var oldAct = $(form).get('action');
	form.method='post';
	form.set('action', './dashboard.php?p=laporan_detil');
	form.submit();
}

function show_printPage(form){
	var oldAct = $(form).get('action');
	form.set('action', document.location+'&sub=printable');
	form.method='post';
	form.set('target','_blank');
	form.submit();
	form.set('action', oldAct);	
	form.set('target','_self');
}

window.addEvent('domready', function(){
	var form = $(document.frmSearch);
	dep_updateLabel(form.departemenID);
	search_updateTable(form);
});

<?php endif;?>
</script>	
<?php }
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include 'model/periode.php';
include 'model/departemen.php';
include 'model/bobotLevel.php';
include 'model/nilaiAkhir.php';
include 'model/nilaiPerPenilai.php';
include 'model/karyawan.php';
include 'model/misc.php';
include 'model/grade.php';

$sub = $_REQUEST['sub'];
if ($sub==='printable'){
	include 'view/admin/laporan_global/global_printable.php';
}
else{
	include 'view/header.php';
	include 'view/admin/laporan_global/global.php';
	include 'view/footer.php';
}