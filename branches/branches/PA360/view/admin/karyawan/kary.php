<script>
	function click_add(){
		document.location = 'dashboard.php?p=karyawan&sub=kary_add';
	}

	function click_edit(kode){
		document.location = 'dashboard.php?p=karyawan&sub=kary_edit&kary_id='+kode;
	}
	
	function kary_sts_add(kode){
		FBModal_loading("Loading", "Please wait...", true, false);
		FBModal_show2( 'proc/karyawan.php', 'post', "proc=stskary-add-modal"+
				"&karyID="+kode,
			true, true);
	}
	
	function kary_sts_history(karyID){
		FBModal_loading("Loading", "Please wait...", true, false);
		FBModal_show2( 'proc/karyawan.php', 'post', "proc=stskary-list&karyID="+karyID,
			true, false);
	}
	
	function kary_sts_delete(karyID, stskaryID, tglUpdate){
		$('stskary-table').set('html',"<tr><td align=\"center\" colspan=\"4\"><div class=\"indicator\"><h3 style=\"padding-top:10px;\"><span style=\"margin-left:40px;\">Saving...</span></h3></div></td>");
		doRequest('proc/karyawan.php', 'post', 'proc=stskary-delete'+
			'&karyID='+karyID+'&stskaryID='+stskaryID+'&tglUpdate='+tglUpdate, 
			function (res){
				kary_sts_update(karyID);
			});
	}
	
	function kary_sts_update(karyID){
		doRequest('proc/karyawan.php', 'post', 'proc=stskary-list-table&karyID='+karyID, 
			function (res){
				$('stskary-table').set('html', res);
			});
	}
	
	function kary_save(form, type){
		FBModal_loading("Save", "Please wait...", true, false);
		$(form).set('send', {
			onSuccess: function(response) { 
				var js = JSON.decode(response);
				var msg = js.error? js.msg : "Process simpan selesai !!!";
				var title = js.error? 'Error' : 'Saving';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true, true);
			}
		}).send();
	}
	
	function click_delete(kode){
		new Request({
			url: 'proc/karyawan.php',
			method: 'post',
			onSuccess: function (res){
				var js = JSON.decode(res);
				var msg = js.error? js.msg : "Process penghapusan selesai !!!";
				var title = js.error? 'Error' : 'Deleting';
				FBModal_show(
					"<h2 class=\"dialog_title\"><span>"+title+"</span></h2>" + 
					"<div class=\"dialog_content\" style=\"padding: 10px 20px\">"+msg+"</div>",
					true,true);
				$('row-'+kode).dispose();
			}	
		}).send("proc=karyawan-delete&kary_id="+ kode);
		
	}
	
	//@key (string) - search key
	function kary_updateList(key){
		if (key==null) key = "";
		doRequest('proc/karyawan.php', 'post', 'proc=kary-table&key='+key, 
			function (res){ 
				$('kary-table').innerHTML = res;
		});
	}
	
	window.addEvent('domready',function() { 
		kary_updateList();
	});
</script>

<!-- kary.php -->
<h2 style="border-bottom: 1px solid #CCC">Daftar Karyawan</h2>
<div class="padT5">Search : <input name="" type="text" style="margin-left:5px; width:200" onkeyup="kary_updateList(this.value)" /></div> 
<table class="marginT5" style="border:1px solid #457A3F;" width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr class="header">
    <th width="100"><h3><span class="colorWhite">Kode</span></h3></th>
    <th><h3><span class="colorWhite">Nama</span></h3></th>
    <th width="100"><h3><span class="colorWhite">Jenis Kelamin</span></h3></th>
    <th width="150"><h3><span class="colorWhite">E-mail</span></h3></th>
    <th width="150"><h3><span class="colorWhite">Tgl Masuk</span></h3></th>
    <th width="150"></th>
  </tr>
  <tbody id="kary-table"></tbody>
</table>
<div class="padT5 alignR" style="width:100%;">
	<a class="fake" onClick="click_add()">Add</a>
	<a class="fake marginL5"></a>
</div>
<!-- kary.php End-->
