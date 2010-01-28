<?php include 'lib/constant.php'?>
<?php include 'lib/config.php'?>
<?php include 'lib/sessionCheck.php'?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Penilaian Kinerja Karyawan</title>
<link rel="stylesheet" type="text/css" href="css/main.css" />
<link rel="stylesheet" type="text/css" href="css/hnav.css" />
<link rel="stylesheet" type="text/css" href="css/fbModal.css" />
<script type="text/javascript" src="jscript/moo.js"></script>
<script type="text/javascript" src="jscript/moop.js"></script>
<script type="text/javascript" src="jscript/fbModal.js"></script>
<script type="text/javascript" src="jscript/main.js"></script>
<?php
 	
	//inject header property/function
	if (function_exists('inject_head'))	
		inject_head();
	
?>
</head>
<body>

<!-- Inner-Body -->
<div id="body-inner">
	<!-- Header -->
	<div>
		<div class="floatL" style="width:382px; height:144px"><img src="image/header.jpg" width="900" height="144" /></div>
		<div class="floatL" align="center">
			<div></div>
			<div></div> 
		</div>
	</div>
	<!-- Header End -->
	
	<!-- Navigation -->
	<div class="clearBoth padT5">
		<?php 	include 'view/menu-hnav.php'?>
	</div>
	<!-- Navigation End-->
	
	<!-- Content -->
	<div id="content" class="clearBoth padT5">