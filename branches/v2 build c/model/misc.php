<?php
function laporan_global($periodeID, $departemenID=false){
	//bikin key
	$KEY = array();
	$BBTLV = bobotlv_select($periodeID);
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] =0;
	}
	mysql_free_result($BBTLV);
	
	//cari datanya
	$RESULT = array();
	$NPP = npp_select("ID_PERIODE='$periodeID'", "KODE_KARYAWAN ASC");
	while ($row = mysql_fetch_assoc($NPP)){
		//load karyawan
		//cari karyawan dengan kode dan id_dep_div_jab, jika sudah ada lanjut
		if (! array_key_exists($row['KODE_KARYAWAN'].'-'.$row['ID_DEP_DIV_JAB'], $RESULT)){
			$KARY = kary_load($row['KODE_KARYAWAN']);
			$KARY = mysql_fetch_assoc($KARY);
			$tmp['KODE_KARYAWAN'] = $KARY['KODE_KARYAWAN'];
			$tmp['NAMA_KARYAWAN'] = $KARY['NAMA_KARYAWAN'];
			
			//jabatan
			$JBT = RELASIJABATAN_load($row['KODE_KARYAWAN'], $row['ID_DEP_DIV_JAB']);
			$JBT = mysql_fetch_assoc($JBT); 
			//do filter
			if ($departemenID && $JBT['ID_DEPARTMENT'] !== $departemenID) continue;
			$tmp['ID_DEP_DIV_JAB'] = $JBT['ID_DEP_DIV_JAB'];
			$tmp['NAMA_JABATAN'] = $JBT['NAMA_JABATAN'];
			$tmp['NAMA_DIVISI'] = $JBT['NAMA_DIVISI'];
			$tmp['NAMA_DEPARTMENT'] = $JBT['NAMA_DEPARTMENT'];
			
			//nilai per penilai
			foreach ($KEY as $key=>$value){
				$tmp[$key] = $value;
			}
			
			//nilai akhir 
			$NA = nilaiAkhir_load($row['KODE_KARYAWAN'], $row['ID_PERIODE'], $row['ID_DEP_DIV_JAB']);
			$NA = mysql_fetch_assoc($NA); 
			$tmp['NILAI_AKHIR'] = $NA['NILAI_AKHIR']==NULL? 0 : $NA['NILAI_AKHIR'];
			
			//append ke result 
			$RESULT[$row['KODE_KARYAWAN'].'-'.$row['ID_DEP_DIV_JAB']] = $tmp;
		}
		
		$RESULT[$row['KODE_KARYAWAN'].'-'.$row['ID_DEP_DIV_JAB']][$row['ID_LEVEL']] = $row['NILAI'];
	}
	mysql_free_result($NPP);
	return $RESULT;
}

function laporan_detail_kripen($karyID, $dep_div_jabID, $periodeID){
	$RESULT=array();
	
	/**
	 * SOLUSI:
	 * 1. table NILAI_PER_PENILAI sebagai reference data, 
	 * 	  cari data dari table NILAI_PER_KRITERIA yang reference ke table NILAI_PER_PENILAI
	 * 2. dari reference data tsb, load data KRITERIA_PENILAIAN (untuk ambil nama kriteria) 
	 * 
	 * BENTUK ARRAY
	 * 	[ID_KRITERIA] => array(
	 * 		<FIELD NILAI_PER_PENILAI>
	 * 			....
	 * 			....
	 * 
	 * 		<FIELD KRITERIA_PENILAIAN>
	 * 			....
	 * 			....
	 * 		
	 * 		[HZ1] => nilai
	 * 			...
	 * 			...
	 * 		[HZ n%] => nilai
	 * 		[VC1] => nilai
	 * 			...		
	 * 			...
	 * 		[VC n%] => nilai
	 * 	)
	 */
	
	//bikin key
	$KEY = array();
	$BBTLV = bobotlv_select($periodeID);
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] =0;
	}
	mysql_free_result($BBTLV);
	
	//1. load data dari table NILAI_PER_KRITERIA
	$sql = "SELECT 
				a.KODE_KARYAWAN, a.PENILAI, a.ID_PERIODE, a.ID_DEP_DIV_JAB, 
				a.ID_KRITERIA, a.ID_LEVEL, a.NILAI
			FROM nilai_per_kriteria as a, nilai_per_penilai as b
			WHERE 
				a.KODE_KARYAWAN = b.KODE_KARYAWAN AND
				a.ID_PERIODE = b.ID_PERIODE AND
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
				a.ID_LEVEL = b.ID_LEVEL AND
				a.ID_PERIODE = '$periodeID' AND 
				a.KODE_KARYAWAN = '$karyID' AND
				a.ID_DEP_DIV_JAB = '$dep_div_jabID'";

	$RS1 = mysql_query($sql);
	while ($rs1 = mysql_fetch_assoc($RS1)){
		
		if (! array_key_exists($rs1['ID_KRITERIA'], $RESULT)){
			//append data $rs1
			foreach($rs1 as $key=>$value){
				if ($key!=='NILAI') $TMP[$key] = $value;	//untuk nilai hilangkan
			}	
			
			//append key, untuk menyimpan data nilai HZ1, HZ2 ....
			foreach ($KEY as $key=>$value){
				$tmp[$key] = $value;
			}
			
			//2. load data kriteria (untuk ambil nama kriteria) 
			$KRIPEN = mysql_fetch_assoc(kripen_load($rs1['ID_KRITERIA']));
			//append data $KRIPEN 
			foreach($KRIPEN as $key=>$value){
				$TMP[$key] = $value;
			}
			
			$RESULT[$rs1['ID_KRITERIA']] = $TMP;
		}
		
		//simpan datanya
		$RESULT[$rs1['ID_KRITERIA']][$rs1['ID_LEVEL']] = $rs1['NILAI']==NULL? 0 : $rs1['NILAI'];
	}
	
	return $RESULT;
}

function laporan_detail_dekripen($karyID, $dep_div_jabID, $periodeID, $kripenID){
	$RESULT=array();
	
	/**
	 * SOLUSI:
	 * 1. dari reference NILAI_PER_KRITERIA, load data NILAI_PER_KINERJA
	 * 2. dari reference NILAI_PER_KINERJA, load data DETAIL_KRITERIA
	 * 
	 * BENTUK ARRAY
	 * 	[ID_KRITERIA] => array(
	 * 		<FIELD NILAI_PER_PENILAI>
	 * 			....
	 * 			....
	 * 
	 * 		<FIELD KRITERIA_PENILAIAN>
	 * 			....
	 * 			....
	 * 		
	 * 		[HZ1] => nilai
	 * 			...
	 * 			...
	 * 		[HZ n%] => nilai
	 * 		[VC1] => nilai
	 * 			...		
	 * 			...
	 * 		[VC n%] => nilai
	 * 	)
	 */
	
	//bikin key
	$KEY = array();
	$BBTLV = bobotlv_select($periodeID);
	while ($row=mysql_fetch_assoc($BBTLV)){
		$KEY[$row['ID_LEVEL']] = 0;
	}
	mysql_free_result($BBTLV);

	//1. load data NILAI_PER_KINERJA
	$sql = "SELECT 
				a.KODE_KARYAWAN, a.PENILAI, a.ID_PERIODE, a.ID_DEP_DIV_JAB, 
				a.ID_DETAIL_KRITERIA, a.ID_LEVEL, a.NILAI
			FROM nilai_per_kinerja as a, nilai_per_penilai as b, detail_kriteria as c
			WHERE 
				a.KODE_KARYAWAN = b.KODE_KARYAWAN AND
				a.ID_PERIODE = b.ID_PERIODE AND
				a.ID_DEP_DIV_JAB = b.ID_DEP_DIV_JAB AND
				a.ID_LEVEL = b.ID_LEVEL AND
			   	a.ID_DETAIL_KRITERIA = c.ID_DETAIL_KRITERIA AND
				a.ID_PERIODE = '$periodeID' AND 
				a.KODE_KARYAWAN = '$karyID' AND
				a.ID_DEP_DIV_JAB = '$dep_div_jabID' AND
			  	c.ID_KRITERIA = '$kripenID'";
	$RS1 = mysql_query($sql); //npk_select($karyID, false, $periodeID, $dep_div_jabID);
	while ($rs1 = mysql_fetch_assoc($RS1)){
			
		if (! array_key_exists($rs1['ID_DETAIL_KRITERIA'], $RESULT)){
			//append data $rs1 
			foreach($rs1 as $key=>$value){
				if ($key!=='NILAI') $TMP[$key] = $value;
			}
			
			//append key, untuk menyimpan data nilai HZ1, HZ2 ....
			foreach ($KEY as $key=>$value){
				$tmp[$key] = $value;
			}
			
			//2. load data DETAIL_KRITERIA
			$DEKRIPEN = dekripen_load($rs1['ID_DETAIL_KRITERIA']);
			foreach(mysql_fetch_assoc($DEKRIPEN) as $key=>$value){
				$TMP[$key] = $value;
			}
			
			$RESULT[$rs1['ID_DETAIL_KRITERIA']] = $TMP;
		}
		
		//simpan datanya
		$RESULT[$rs1['ID_DETAIL_KRITERIA']][$rs1['ID_LEVEL']] = $rs1['NILAI']==NULL? 0 : $rs1['NILAI'];
	}
	
	return $RESULT;
}
