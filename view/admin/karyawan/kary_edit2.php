<script>
window.addEvent('domready',function() { 
	/*	Button search event*/
	var form = document.form1;
	$(form.buttonSearch).addEvent('click', function(){
		search_show();
	});

	$(form).addEvent('submit', function(e){
		new Event(e).stop();

		//show the loading indicator
		FBModal_loading("Validating", "Please wait...", false, false);
		this.set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Validating';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true,true);
					
				if (! js.error) document.location = "dashboard.php?p=karyawan";
			}
		}).send();
	});
	dtpicker_attach('.dtpick');
});

/*add alamat*/
function alamat_add(){
	//show the loading indicator
	FBModal_show2(
		'proc/karyawan.php', 
		'post', 
		"proc=alamat-modal",
		true, true);
}

/*save alamat*/
var ALAMAT_TABLE_ID = 0;
function alamat_save(){
	FBModal_hide();
	//request the data
	var id = ++ALAMAT_TABLE_ID;
	var fm = $(document.formAlamat);
	var kdpos = isNaN(parseInt(fm.kodePos.value))? 0 : parseInt(fm.kodePos.value);
	var kdarea = isNaN(parseInt(fm.kodeArea.value))? 0 : parseInt(fm.kodeArea.value);

	if (fm.alamat.value=='' && kdpos==0 && kdarea==0 && fm.kota.value=='' && fm.propinsi.value=='') 
		return;
	
	new Request({
		url: 'proc/karyawan.php',
		method: 'post',
		onSuccess: function (res){
			//debug
//			alert(res);
			$('alamat-table').innerHTML += res;
		}	
	}).send("proc=alamat-list&" +
			"id=alamat-table"+ id +"&" +
			"alamat="+ fm.alamat.value +"&" +
			"kodePos="+ kdpos +"&" +
			"kodeArea="+ kdarea +"&" +
			"kota="+ fm.kota.value +"&" +
			"propinsi="+ fm.propinsi.value);
}

/*delete alamat*/
function alamat_delete(el, alamatID){
	doRequest('proc/karyawan.php', 'post', 
		'proc=alamat-list-delete&'+
		'alamatID='+alamatID+
		'&karyID='+document.form1.kode.value, null,
		function(res){
			var js = JSON.decode(res);
			if (! js.error) {
				$(el).nix();
			}
			else{
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>Delete</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>",
					true,true);
			}
		});
}

function tlp_add(el){
	//show the loading indicator
	FBModal_show2(
		'proc/karyawan.php', 
		'post', 
		"proc=tlp-modal&title=Add Nomor Telepon",
		true, true);
}

var TLP_TABLE_ID = 0;
function tlp_save(){
	FBModal_hide();
	//request the data
	var id = ++TLP_TABLE_ID;
	var fm = $(document.formTlp);
	var tlp = isNaN(parseInt(fm.tlp.value))? 0 : parseInt(fm.tlp.value);
	if (tlp=='' || tlp==0) return;
	new Request({
		url: 'proc/karyawan.php',
		method: 'post',
		onSuccess: function (res){
			$('tlp-table').innerHTML += res;
		}	
	}).send("proc=tlp-list&tlp="+ tlp + "&id=tlp-table"+ id);
}

function tlp_delete(el, tlpID){
	doRequest('proc/karyawan.php', 'post', 
		'proc=tlp-list-delete&'+
		'tlpID='+tlpID+
		'&karyID='+document.form1.kode.value, null,
		function(res){
			var js = JSON.decode(res);
			if (! js.error) {
				$(el).nix();
			}
			else{
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>Delete</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>",
					true,true);
			}
		});
}

function search_show(){
	FBModal_show2(
			'proc/karyawan.php', 
			'post', 
			"proc=karyawan-search",
			true, true);
}

function search_go(keyEl){
	var form = $(document.formPencarianKary);
	new Request({
		url: 'proc/karyawan.php',
		method: 'get',
		onSuccess: function (res){
//			alert(res);
			$('karyawan-search-table').innerHTML = res;
		}	
	}).send("proc=karyawan-search-list&key="+ keyEl.value);
}

/**
 * pilih satu dari search list, redirect ke halaman edit
 * @var kary_id (String) - kode karyawan
 */
function search_pick(kary_id){
	document.location = 'dashboard.php?p=karyawan&sub=kary_edit&kary_id='+kary_id;
}

function mod_enter(e, source){
	if (e.keyCode == 13) {
		new Event(e).stop();
		search_pick(source.value);
	}
}

var JOB_TABLE_ID = 0;
function job_add(){
	var trID = 'job-table' + (++JOB_TABLE_ID);
	FBModal_show2( 'proc/karyawan.php', 'post', "proc=job-modal&trID="+trID, true, false, null,
		{onSuccess: function (res){ dtpicker_attach('.dtpick'); }
	});
}
function job_save(form){
	$(form).set('send', {
			onSuccess: function(response) { 
				$('job-table').innerHTML += response;
			}
		}).send();
}

function job_delete(el, dep_div_jabID){
	doRequest('proc/karyawan.php', 'post', 
		'proc=job-list-delete&'+
		'dep_div_jabID='+dep_div_jabID+
		'&karyID='+document.form1.kode.value, null,
		function(res){
			var js = JSON.decode(res);
			if (! js.error) {
				$(el).nix();
			}
			else{
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>Delete</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+js.msg+"</div>",
					true,true);
			}
		});
}

function gol_add(){
	var gol = "";
	for (i=0; i<GOL_TABLE_ID; i++){
		if (GOL_ARR[i]!= null && GOL_ARR[i] !=""){
			gol += GOL_ARR[i];
			gol += (i+1<GOL_ARR.length && GOL_ARR[i+1]!=null && GOL_ARR[i+1]!="")? "," : "";
		}
	}
	var trID = 'gol-table' + (++GOL_TABLE_ID);
	FBModal_show2( 'proc/karyawan.php', 'post', "proc=gol-modal&exclude="+gol+"&trID="+trID, true, false, null,
		{onSuccess: function (res){
			dtpicker_attach('.dtpick');
		}
	});
}

var GOL_TABLE_ID = 0;
var GOL_ARR = new Array();
function gol_save(form){
	GOL_ARR[GOL_TABLE_ID-1] = form.golID.value;
	$(form).set('send', {
		onSuccess: function(response) { 
			//alert(response);
			$('gol-table').innerHTML += response;
		}
	}).send();
}

function _gol_arr_clear(id){
	for (i=0; i<GOL_ARR.length; i++){
		if (GOL_ARR[i] == id) GOL_ARR[i] = null;
	}
}
</script>

<?php
include_once 'model/departemen.php';
include_once 'model/divisi.php';
include_once 'model/jabatan.php';
include_once 'model/golongan.php';

$kode = $_GET['kary_id'];
$kary = kary_load_complete($kode);
?>
<!-- kary_edit.php -->
<form name="form1" method="post" action="proc/karyawan.php">
	<input type="hidden" value="karyawan-update" name="proc" />
  <h2 style="border-bottom: 1px solid #CCC">Identitas Karyawan</h2>
  <div>
  	<div>
		<div class="padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Kode Karyawan : </div>
			<input name="kode" type="text" class="vMiddle floatL" value="<?php echo $kary['KODE_KARYAWAN']?>" onkeypress="mod_enter(event, this)">
			<input name="buttonSearch" type="button" class="vMiddle floatL" value="search" style="margin-left:10px;">
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Nama Karyawan : </div>
			<input name="nama" type="text" class="vMiddle floatL" value="<?php echo $kary['NAMA_KARYAWAN']?>">
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Tempat Lahir : </div>
			<input name="tmLahir" type="text" class="vMiddle floatL" id="tmLahir" value="<?php echo $kary['TEMPAT_LAHIR']?>">
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Tanggal Lahir : </div>
			<input type="text" class="dtpick vMiddle floatL" name="tglLahir" value="<?php echo strtotime($kary['TANGGAL_LAHIR'])?>" />
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Jenis Kelamin : </div>
			<input name="kelamin" type="radio" class="vMiddle floatL" value="0" <?php echo $kary['JENIS_KELAMIN']==0? "checked=\"checked\"" : '';?> /> 
			<div class="floatL marginL5">Laki-laki</div>
			<input name="kelamin" type="radio" class="vMiddle floatL marginL10" value="1" <?php echo $kary['JENIS_KELAMIN']==1? "checked=\"checked\"" : '';?> /> 
			<div class="floatL marginL5">Perempuan</div>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Golongan Darah : </div>
			<input name="darah" type="radio" class="vMiddle floatL" value="A" <?php echo $kary['GOLONGAN_DARAH']==='A'? "checked=\"checked\"" : '';?> /> <div class="floatL marginL5">A</div>
			<input name="darah" type="radio" class="vMiddle floatL marginL10" value="B"  <?php echo $kary['GOLONGAN_DARAH']==='B'? "checked=\"checked\"" : '';?> /> <div class="floatL marginL5">B</div>
			<input name="darah" type="radio" class="vMiddle floatL marginL10" value="AB" <?php echo $kary['GOLONGAN_DARAH']==='AB'? "checked=\"checked\"" : '';?> /> <div class="floatL marginL5">AB</div>
			<input name="darah" type="radio" class="vMiddle floatL marginL10" value="O" <?php echo $kary['GOLONGAN_DARAH']==='O'? "checked=\"checked\"" : '';?> /> <div class="floatL marginL5">O</div>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Alamat : </div>
			<div class="floatL">
				<table width="702" border="0" cellpadding="5" cellspacing="0" class="list">
					<tr class="header">
						<th width="250"><h3><span class="colorWhite">Alamat</span></h3></th>
						<th width="100"><h3><span class="colorWhite">Kode Pos</span></h3></th>
						<th width="100"><h3><span class="colorWhite">Kode Area </span></h3></th>
						<th width="100"><h3><span class="colorWhite">Kota</span></h3></th>
						<th width="100"><h3><span class="colorWhite">Propinsi</span></h3></th>
					    <th></th>
					</tr>
					<tbody id="alamat-table" style="overflow: scroll; overflow-x:hidden; height: 60px;">
					<?php foreach ($kary['ALAMAT'] as $alm):?>
						<?php $trID = 'alamat-table-stored-' . (++$z);
							$alamatID = $alm['ID_ALAMAT'];
							$alamat = $alm['NAMA_ALAMAT'];
							$kodePos = $alm['KODE_POS'];
							$kodeArea = $alm['KODE_AREA'];
							$kota = $alm['KOTA'];
							$propinsi = $alm['PROPINSI'];
							include 'kary_alamatList.php';?>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div class="clearBoth alignR" style="width:702px;"><a class="fake" onClick="alamat_add()">Add</a></div>
			</div>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">No Telepon : </div>
			<div class="floatL">
				<table width="200px" border="0" cellpadding="5" cellspacing="0"  class="list">
					<tr class="header"><td><h3><span class="colorWhite">No. Telpon</span></h3></td><td></td><td></td></tr>
					<tbody style="overflow: scroll; overflow-x:hidden; height: 60px;" id="tlp-table">
					<?php foreach ($kary['TELPON'] as $alm):?>
						<?php $trID = 'tlp-table-stored' . (++$z);
							  $tlp = $alm['NO_TELPON'];
							  include 'kary_tlpList.php';?>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<div style="width: 320px;" class="alignR clearBoth"><a class="fake" onClick="tlp_add()">Add</a></div>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">E-mail : </div>
			<input name="email" type="text" class="vMiddle floatL" value="<?php echo $kary['EMAIL']?>">
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Status : </div>
			<select name="status" class="vMiddle floatL">
				<option value="BK" <?php echo  $kary['STATUS']==="BK"? "selected=\"selected\"" : ""?>>Belum Kawin</option>
				<option value="K" <?php echo  $kary['STATUS']==="K"? "selected=\"selected\"" : ""?>>Kawin</option>
				<option value="DJ" <?php echo  $kary['STATUS']==="DJ"? "selected=\"selected\"" : ""?>>Duda/Janda</option>
			</select>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Agama : </div>
			<select name="agama" class="vMiddle floatL">
				<option value="B" <?php echo  $kary['AGAMA']==="B"? "selected=\"selected\"" : ""?>>Budha</option>
				<option value="H" <?php echo  $kary['AGAMA']==="H"? "selected=\"selected\"" : ""?>>Hindu</option>
				<option value="I" <?php echo  $kary['AGAMA']==="I"? "selected=\"selected\"" : ""?>>Islam</option>
				<option value="K" <?php echo  $kary['AGAMA']==="K"? "selected=\"selected\"" : ""?>>Kristen</option>
				<option value="L" <?php echo  $kary['AGAMA']==="L"? "selected=\"selected\"" : ""?>>Lain-lain</option>
			</select>
		</div>
		
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Jabatan : </div>
			<div class="floatL">
				<table width="725" border="0" cellpadding="0" cellspacing="0" class="list">
					<tr class="header">
						<td width="125" align="center"><h3><span class="colorWhite">Depratemen</span></h3></td>
						<td width="125" align="center"><h3><span class="colorWhite">Divisi</span></h3></td>
						<td width="125" align="center"><h3><span class="colorWhite">Jabatan</span></h3></td>
						<td width="125" align="center"><h3><span class="colorWhite">Tgl. Menjabat</span></h3></td>
						<td width="125" align="center"><h3><span class="colorWhite">Tgl. Berhenti</span></h3></td>
						<td width="100" align="center">&nbsp;</td>
					</tr>
					<tbody id="job-table" style="overflow: scroll; height: 60px;">
					<?php foreach ($kary['JABATAN'] as $alm):?>
						<?php $trID = 'job-table-stored' . (++$z);
							  $dep_div_jabID = $alm['ID_DEP_DIV_JAB'];
							  $depID = $alm['ID_DEPARTMENT'];
							  $divID = $alm['ID_DIVISI'];
							  $jabID = $alm['ID_JABATAN'];
							  $tglMenjabat = strtotime($alm['TANGGAL_MENJABAT']);
							  $tglBerhenti = strtotime($alm['TANGGAL_BERHENTI']);
							  include 'kary_jobList.php';?>
					<?php endforeach; ?>
					</tbody>
				</table>
				<div style="width:725px;" align="right"><a class="fake" onclick="job_add()">Add</a></div>
			</div>
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Golongan : </div>
			<div class="floatL">
				<table width="549" border="0" cellpadding="0" cellspacing="0" class="list">
					<tr class="header">
						<td width="150" align="center"><h3><span class="colorWhite">Golongan</span></h3></td>
					    <td width="150" align="center"><h3><span class="colorWhite">Tgl Menjabat</span></h3></td>
				        <td width="150" align="center"><h3><span class="colorWhite">Tgl Berhenti </span></h3></td>
			          <td width="99" align="center">&nbsp;</td>
					</tr>
					<tbody id="gol-table" style="overflow: scroll; height: 60px;">
						<?php foreach ($kary['GOLONGAN'] as $alm):?>
						<?php $trID = 'gol-table-stored' . (++$z);
							  $golID = $alm['ID_GOLONGAN'];
							  $tglMenjabat = strtotime($alm['TANGGAL_MENJABAT']);
							  $tglBerhenti = strtotime($alm['TANGGAL_BERHENTI']);
							  include 'kary_golList.php';?>
						<?php endforeach; ?>
					</tbody>
				</table>
				<div style="width:549px;" align="right"><a class="fake" onclick="gol_add()">Add</a></div>
			</div>
		</div>
		
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Tanggal Masuk :  </div>
			<input type="text" class="dtpick vMiddle floatL" name="tglMasuk" value="<?php echo strtotime($kary['TANGGAL_MASUK'])?>" />
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Tanggal Keluar : </div>
			<input type="text" class="dtpick vMiddle floatL" name="tglKeluar" value="<?php echo strtotime($kary['TANGGAL_KELUAR'])?>" />
		</div>
		<div class="clearBoth padT5">
			<div style="width:120px;" class="floatL padR5 alignR">Status Kerja : </div>
			<select name="statusKerja" class="vMiddle floatL">
				<?php $STSKARY =  stskary_select(); ?>
				<?php while($row = mysql_fetch_assoc($STSKARY)): ?>
				<option value="<?php echo $row['ID_STATUS_KARYAWAN']?>" <?php echo $kary['ID_STATUS_KARYAWAN']===$row['ID_STATUS_KARYAWAN']? "selected=\"selected\"" : ""?>><?php echo $row['NAMA_STATUS']?></option>
				<?php endwhile;?>
			</select>
		</div>
	</div>
  </div>
  <div class="clearBoth padT10"></div>
  <div align="center" class="clearBoth marginV5 padT10" style="border-top:1px solid #000; margin-top:20px;">
  	<input name="buttonSubmit" type="submit" value="Save" />
  </div>
</form>
<!-- kary_add.php End-->