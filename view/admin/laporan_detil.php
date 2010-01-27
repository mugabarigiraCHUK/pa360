<?php
function inject_head(){?>
<script>
<?php if ($_REQUEST['sub']==='printable'):?>
window.addEvent('domready', function(){
	window.print();
});
<?php else :?>
function searchKary_modal(){
	FBModal_show2('proc/admin/laporan_detil.php','post', "proc=searchKary-modal", true, true);
}

function searchKary_updateTable(form){
	form.set('send', {
		onSuccess: function(response) {
			$('searchKary-table').set('html', response);
		}
	}).send();
}

function searchKary_pick(karyID, karyNama){
	FBModal_hide();
	var form = $(document.frmSearch);
	form.karyLabel.value = karyNama;
	form.karyID.value = karyID;
	updateJabatanCombo($(document.frmSearch));
}

function show_printPage(form){
	form.set('action', document.location+'&sub=printable');
	form.set('method', 'post'); 
	form.set('target','_blank');
	form.submit();
}

function updateJabatanCombo(form){
	if (form.karyID.value=='') { return; }
	doRequest('proc/admin/laporan_detil.php', 'post', 'proc=jbt-combo'+
				'&karyID='+form.karyID.value+
				'&dep_div_jabID='+form.dep_div_jabID2.value, 
		function (res){ 
			var cb = $(form).dep_div_jabID;
			cb.set('html', form.karyID.value==''? '' : res);

			var cc = cb.options[cb.selectedIndex];
			updateJabataLabels(cc);
			search_updateTable(form);
	});
}

function updateJabataLabels(opt){
	$('departemenLabel').set('html', opt.getProperty('departemen'));
	$(document.frmSearch).departemenID.value=opt.getProperty('departemenID');
	$('divisiLabel').set('html', opt.getProperty('divisi'));
}

function search_updateTable(form){
	$(form).proc.value = 'search-table';
	form.set('action', 'proc/admin/laporan_detil.php');
	form.set('method', 'post'); 
	form.set('send', {
		onSuccess: function(response) { 
			$('search-table').set('html', response);
		}
	}).send();
}

window.addEvent('domready', function(){
	updateJabatanCombo(document.frmSearch);	
	search_updateTable(document.frmSearch);
});
<?php endif;?>
</script>	
<?php }

include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/tag.php';
include_once 'model/periode.php';
include_once 'model/departemen.php';
include_once 'model/bobotLevel.php';
include_once 'model/detilBobotLevel.php';
include_once 'model/nilaiAkhir.php';
include_once 'model/nilaiPerPenilai.php';
include_once 'model/karyawan.php';
include_once 'model/misc.php';
include_once 'model/kriteriaPenilaian.php';
include_once 'model/nilaiPerKinerja.php';
include_once 'model/nilaiPerKriteria.php';
include_once 'model/detilKriteriaPenilaian.php';
	
$sub = $_REQUEST['sub'];
if ($sub==='printable'){
	include 'view/admin/laporan_detil/detil_printable.php';
}	
else{
	$karyID = $_REQUEST["karyID"];
	$periodeID = $_REQUEST["periodeID"];
	$departemenID = $_REQUEST["departemenID"];
	$dep_div_jabID = $_REQUEST["dep_div_jabID"];
	include 'view/header.php';
	include 'view/admin/laporan_detil/detil.php';
	include 'view/footer.php';
}