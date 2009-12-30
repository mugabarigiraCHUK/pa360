<?php
include_once '../lib/config.php';
include_once '../lib/db.php';
include '../lib/utils/tag.php';
include '../model/jabatan.php';

$proc = $_REQUEST['proc'];

if ($proc === 'add-modal'){
?>
<form name="frmModal" action="proc/jabatan.php"> 
<input type="hidden" name="proc" value="jabatan-save" />
<h2 class="dialog_title"><span>Add Jabatan</span></h2>
  <div class="dialog_content">
	  <table width="406" border="0" cellpadding="0" cellspacing="5">
		<tr>
		  <td width="125" align="right">ID Jabatan : </td>
		  <td width="265"><input type="text" name="jbt_id"></td>
		</tr>
		<tr>
		  <td align="right">Nama Jabatan : </td>
		  <td><input type="text" name="nama"></td>
		</tr>
		<tr>
		  <td align="right">Level Jabatan : </td>
		  <td><?= tag_numberOnSelect(1, 10, 1, 'level[0]')?> <?= tag_numberOnSelect(1, 10, 1, 'level[1]')?></td>
		</tr>
	  </table>
	</div>
	<div class="dialog_buttons">
		<input type="button" name="Submit" value="Save" onclick="jabatan_save(document.frmModal)">
		<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
	</div>
</form>
<?php 
}

if ($proc === 'edit-modal'){
	$jbtID = $_POST['jbt_id'];
	$data = jbt_load($jbtID);
	$data = mysql_fetch_assoc($data);
?>
<form name="frmModal" action="proc/jabatan.php"> 
<input type="hidden" name="proc" value="jabatan-update" />
<h2 class="dialog_title"><span>Add Jabatan</span></h2>
  <div class="dialog_content">
	  <table width="406" border="0" cellpadding="0" cellspacing="5">
		<tr>
		  <td width="125" align="right">ID Jabatan : </td>
		  <td width="265">
		  	<input type="text" name="jbt_id-fake" value="<?=$jbtID?>" disabled="disabled">
		  	<input type="hidden" name="jbt_id" value="<?=$jbtID?>" />
		  </td>
		</tr>
		<tr>
		  <td align="right">Nama Jabatan : </td>
		  <td><input type="text" name="nama" value="<?=$data['NAMA_JABATAN']?>"></td>
		</tr>
		<tr>
		  <td align="right">Level Jabatan : </td>
		  <?php 
		  	$level = $data['LEVEL_JABATAN'];
		  	$level = explode(".", $level);
		  ?>
		  <td><?= tag_numberOnSelect(1, 10, $level[0], 'level[0]')?> <?= tag_numberOnSelect(1, 10, $level[1], 'level[1]')?></td>
		</tr>
<!--		<tr>-->
<!--		  <td align="right">&nbsp;</td>-->
<!--		  <td><input type="button" name="Submit" value="Save" onclick="jabatan_update(document.frmModal)"></td>-->
<!--		</tr>-->
	  </table>
	</div>	
	<div class="dialog_buttons">
		<input type="button" name="Submit" value="Save" onclick="jabatan_update(document.frmModal)">
		<input type="button" value="Close" name="close" onclick="FBModal_hide()" />
	</div>
</form>
<?php 
}

/**
 * simpan jabatan
 */
if ($proc === 'jabatan-save'){
	$id=$_POST['jbt_id'];
	$nama=$_POST['nama'];
	$level=$_POST['level'];
	
	if (!$id || $id===''){
		echo json_encode(array('error'=> true, 'msg'=> 'ID Jabatan mohon diisi...'));
		return;
	}
	
	$ex = jbt_insert($id, $nama, $level[0] .'.'. $level[1]);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'jabatan-update'){
	$id = $_POST['jbt_id'];
	$nama = $_POST['nama'];
	$level = $_POST['level'];
	$ex = jbt_update($id, $nama, $level[0] .'.'. $level[1]);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

if ($proc === 'jabatan-delete'){
	$id=$_REQUEST['jbt_id'];
	$ex = jbt_delete($id);
	echo json_encode(array('error'=> !$ex, 'msg'=> mysql_error()));
}

/**
 * list pada jabatan table
 */
if ($proc === 'jabatan-table-list'){
	$key = $_POST['key'];
	include '../view/admin/jabatan/tableList.php';
}

