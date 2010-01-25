<?php 
include_once 'lib/config.php';
include_once 'lib/db.php';
include_once 'lib/utils/date.php';
include_once 'model/karyawan.php';

function inject_head(){
	?>
<link rel="stylesheet" type="text/css" href="css/datepicker_vista.css" />
<script type="text/javascript" src="jscript/datepicker.js"></script>
	<?php 
	if (function_exists('_inject_head')){
		_inject_head();
	}
}

include 'view/header.php';

//sub page
$sub = $_REQUEST['sub'];
if ($sub === 'kary_add'){
	include 'view/admin/karyawan/kary_add.php';
}
else if ($sub === 'kary_edit'){
	include 'view/admin/karyawan/kary_edit2.php';
}
else{
	include 'view/admin/karyawan/kary.php';
}

include 'view/footer.php';
