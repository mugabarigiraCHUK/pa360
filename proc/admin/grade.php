<?php
include_once '../../lib/config.php';
include_once '../../lib/db.php';
include_once '../../lib/utils/tag.php';
include '../../model/periode.php';
include '../../model/grade.php';
include '../../model/deskripsiBobot.php';

$proc = $_REQUEST['proc'];

switch($proc){
	case 1 :	//add modal
		$periodeID = $_POST['periodeID'];
		include '../../view/admin/grade/add.php';
		break;
		
	case 11 :	//save 
		$periodeID = $_POST['periodeID'];
		$gradeName = $_POST['name'];
		$gradeMin = $_POST['min'];
		$gradeMax = $_POST['max'];
		
		if ($gradeName === '' || is_null($gradeName)){
			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi nama grade"));
			return ;
		}
		
		//check grade min/max value
		if ($gradeMin>$gradeMax){
			echo json_encode(array('error'=> true, 'msg'=> "Nilai grade tidak sesuai"));
			return ;
		}
		
		$ex = grd_insert($gradeName, $periodeID, $gradeMin, $gradeMax);
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		break;
		
	case 0:	//table
		$periodeID = $_POST['periodeID'];
		include '../../view/admin/grade/table.php';
		break;
		
	case 3: //delete
		$gradeID = $_POST['gradeID'];
		$ex = grd_delete($gradeID);
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		break;
		
	case 2:
		$gradeID = $_POST['gradeID'];
		include '../../view/admin/grade/edit.php';
		break;
		
	case 22:
		$gradeID = $_POST['gradeID'];
		$periodeID = $_POST['periodeID'];
		$gradeName = $_POST['name'];
		$gradeMin = $_POST['min'];
		$gradeMax = $_POST['max'];
		
		if ($gradeName === '' || is_null($gradeName)){
			echo json_encode(array('error'=> true, 'msg'=> "Mohon mengisi nama grade"));
			return ;
		}
		
		//check grade min/max value
		if ($gradeMin>$gradeMax){
			echo json_encode(array('error'=> true, 'msg'=> "Nilai grade tidak sesuai"));
			return ;
		}
		
		$ex = grd_update($gradeID, $gradeName, $periodeID, $gradeMin, $gradeMax);
		echo json_encode(array('error'=> !$ex, 'msg'=> mysql_innodb_error(mysql_errno())));
		break;
}