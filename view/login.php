<?php include 'lib/constant.php'?>
<?php include 'lib/config.php'?>

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
	<!-- <div>
		<div class="floatL" style="width:382px; height:144px"><img src="image/header.jpg" width="900" height="144" /></div>
		<div class="floatL" align="center">
			<div></div>
			<div></div> 
		</div>
	</div> -->
	<!-- Header End -->
	
	<!-- Content -->
	<div id="content" class="clearBoth padT5">
	
<!-- Login.php -->
<div style="padding:50px 0;"></div>
<div style="margin:auto; width:700px;">
<form id="login-form" name="form1" method="post" action="lib/login.php?p=login">
	<div style="border:1px solid #CCCCCC; background-color:#FFFFFF;">
		<div style=" margin:20px">
			<div style="border-bottom:2px solid #999999; padding-bottom:5px"><h1>Login</h1></div>
			<div style="margin-top:20px">
				<table width="100%" border="0" cellpadding="5" cellspacing="0">
				<tr>
					<td width="200px" align="right"><div style="margin-right:20px"><h4>Username : </h4></div></td>
					<td><input name="username" type="text"  style="width:200px"/>
				    <input type="hidden" name="attemps" value="<?=$attemps?>" />
					<input name="timestamp" type="hidden" value="<?=microtime()?>" /></td>
				</tr>
				<tr>
				  <td align="right"><div style="margin-right:20px"><h4>Password : </h4></div></td>
				  <td><input name="password" type="password"  style="width:200px"/></td>
				  </tr>
				<tr>
				  <td align="right" valign="middle">&nbsp;</td>
				  <td valign="middle"><input type="checkbox" name="asAdmin" value="checkbox" /> <span style="color:#336600"><strong>login as Administrator</strong></span></td>
				  </tr>
				<tr>
				  <td align="right">&nbsp;</td>
				  <td><label>
				    <input type="submit" name="Login" value="Submit" />
				  </label></td>
				  </tr>
				</table>

			</div>
		</div>
	</div>
</form>
</div>
<!-- Login.php end -->

	</div>
	<!-- Content End-->
	<!-- <div style="padding-top:20px">
		<img src="image/foot.jpg" width="900" height="90"/>
	</div>  -->
</div>
<!-- Inner-Body End-->
<?php include 'view/fbModal.php'?>
</body>
</html>