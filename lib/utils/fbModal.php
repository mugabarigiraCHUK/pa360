<?php
$modalType = $_POST['modalType'];

if ($modalType==='indicator_loading'){
	$title = $_POST['title'];
	$message = $_POST['msg'];?>
	<h2 class="dialog_title"><span><?php echo $title?></span></h2>
	<div class="dialog_content" style="padding: 10px 20px">
	<table>
	<tbody>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;"><?php echo $message?></h3></td>
		</tr>
	</tbody>
	</table>
	</div><?php 
}

if ($nodalType === 'option-yesNo'){
	$title = $_POST['title'];
	$message = $_POST['msg'];?>
	<h2 class="dialog_title_question"><span><?php echo $title?></span></h2>
	<div class="dialog_content" style="padding: 10px 20px">
	<table>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;"><?php echo $message?></h3></td>
		</tr>
	</table>
	</div><?php
}

/********************************
 * Default content
 * ******************************
<h2 class="dialog_title"><span>David Walsh</span></h2>
<div class="dialog_content">
<div class="dialog_summary">You must be friends with David Walsh to
see their full profile.</div>
<div class="dialog_body">
<div class="ubersearch search_profile">
<div class="result clearfix">
<div class="image"><span><img class="photo" alt="David Walsh"
	src="http://profile.ak.facebook.com/v222/282/0/n211704301_1944.jpg" /></span>
</div>
<div class="info">
<p><b>About David Walsh</b><br />
David Walsh, Web Developer</p>
<p>I'm a 25 year old Web Developer planted in Madison, Wisconsin. I
am Founder and Lead Developer for Wynq Web Labs. I don't design the
websites, I just make them work.</p>
</div>
<div class="clear" style="clear: both;"></div>
</div>
</div>
</div>
<div class="dialog_buttons"><input type="button" value="Close"
	name="close" class="inputsubmit" id="fb-close" /></div>
</div>
*/