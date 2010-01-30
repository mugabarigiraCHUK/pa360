<?php include_once 'lib/config.php'; ?>
<?php include_once 'lib/db.php'; ?>
<?php include_once 'lib/utils/tag.php';?>
<?php include_once 'model/periode.php'; ?>

<?php function inject_head(){?>
<script>
	function update_periodeCombo(form, callback){
		FBModal_loading("Loading", "Please wait...", true, false,1500);
		form.proc.value="periode-combo";
		form.periodeEnd.set('html', "");
		$(form).set('send', {
			onSuccess: function(response) {
				FBModal_hide();
				form.periodeEnd.set('html', response);
				callback(form);
			}
		}).send();
	}

	function update_graph(form){
		form = $(form);

		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		
		var oldreq = form.retrieve('request');
		if ($defined(oldreq)) oldreq.cancel();
		
		var req = doRequest('proc/admin/laporan_periodeGraph.php', 'post', 
			'proc=graph&periodeStart='+form.periodeStart.value+ 
			'&periodeEnd='+form.periodeEnd.value, null, 
			function(res){
				$('graphIndicator').get('reveal').dissolve();
				$('graphContainer').set('html', res);
			});
		form.store('request', req);
	}

	var counter=0;
	window.addEvent('domready', function(){
		update_periodeCombo(document.frmSearch, update_graph);
//		update_periodeCombo(document.frmSearch2, update_graph2);

		var func = function(){
			counter++;	
			if (counter%2==0) update_graph(document.frmSearch);
			else update_graph2(document.frmSearch);
			func.delay(10000);
		};
		func.delay(10000);
	});

	function update_graph2(form){
		$('graphIndicator').get('reveal').reveal();
		$('graphContainer').getChildren().nix();
		form.action = "proc/admin/laporan_rataKinerjaGraph.php";
		form.proc.value="graph";
		$(form).set('send', {
			onSuccess: function(response) {
				$('graphContainer').set('html', response);
				$('graphIndicator').get('reveal').dissolve();
			}
		}).send();
	}
</script>
<?php } ?>

<?php include 'view/header.php'; ?>
<div class="padT10"><h1>Periode Overview</h1></div>
<form name="frmSearch" action="proc/admin/laporan_periodeGraph.php" method="post">
<input name="proc" type="hidden" value="" />
<div class="padT5">Periode :
	<select name="periodeStart" onchange="update_periodeCombo($(this).getParent('form'))" class="marginL5 marginR5">
	<?php $periodeStart = false; ?>
	<?php $PERIODE = periode_select(); ?>
	<?php $periodeCount = mysql_affected_rows() ?>
	<?php for ($i=0; $i<$periodeCount-1; $i++):?>
	<?php		$row = mysql_fetch_assoc($PERIODE); ?>
	<?php		$periodeStart= $periodeStart===false? $row['ID_PERIODE'] : $periodeAwal; ?>
		<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
	<?php endfor; ?>
	</select> <span> - </span>
	<select name="periodeEnd" class="marginL5" onchange="update_graph($(this).getParent('form'))"></select>
</div>
</form>
<div class="padT10"></div>
<div>
	<div id="graphIndicator" style="padding:10px 0; margin:auto; display:none" align="center">
	<table width="200px">
	<tbody>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;">Rendering Image...</h3></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div id="graphContainer" align="center"></div>
</div>

<!-- 
<div class="padT10"><h1>Performance Overview</h1></div>
<form name="frmSearch2" action="proc/admin/laporan_rataKinerjaGraph.php" method="post">
<input name="proc" type="hidden" value="graph" />
<div class="padT5">Periode :
	<select name="periodeStart" onchange="update_periodeCombo($(this).getParent('form'))" class="marginL5 marginR5">
	<?php $periodeStart = false; ?>
	<?php $PERIODE = periode_select(); ?>
	<?php $periodeCount = mysql_affected_rows() ?>
	<?php for ($i=0; $i<$periodeCount-1; $i++):?>
	<?php		$row = mysql_fetch_assoc($PERIODE); ?>
	<?php		$periodeStart= $periodeStart===false? $row['ID_PERIODE'] : $periodeAwal; ?>
		<option value="<?=$row['ID_PERIODE']?>"><?=$row['ID_PERIODE']?></option>
	<?php endfor; ?>
	</select> <span> - </span>
	<select name="periodeEnd" class="marginL5" onchange="update_graph2($(this).getParent('form'))"></select>
</div>
</form>
<div class="padT10"></div>
<div>
	<div id="graphIndicator2" style="padding:10px 0; margin:auto; display:none;" align="center">
	<table width="200px">
	<tbody>
		<tr>
			<td><div class="indicator" ></div></td>
			<td><h3 style="margin-left: 5px;">Rendering Image...</h3></td>
		</tr>
	</tbody>
	</table>
	</div>
	<div id="graphContainer2" align="center"></div>
</div> 
-->
<?php include 'view/footer.php'; ?>