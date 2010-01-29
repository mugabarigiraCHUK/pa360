<?php if ($karyID===''):?>
<tr <?=tag_zebra($z++)?>>
	<td colspan="5" align="center">
		<h3>Pilih Karyawan, <a class="fake" onclick="penilai_searchKary_modal()">search</a>
		</h3>
	</td>
</tr>
<?php 	exit(); ?>
<?php endif;?>

<?php 
$levelID = $stsPenilaian;
//load bobot_level, cari id-nya
$bobotlvID = mysql_fetch_assoc( bobotlv_select(false, $periodeID, $levelID) );
$bobotlvID = $bobotlvID['ID_BOBOT_LEVEL'];

//load penilai, cari id-nya jika ada
$penilaiTable = mysql_fetch_assoc( penilai_load($karyID, $dep_div_jabID) );
$penilaiID = $penilaiTable['KODE_PENILAI'];

//sql search
if ($departemenID){
	$sql_dep = "AND d.ID_DEPARTMENT='$departemenID'";
}
$sql = 
"SELECT a.KODE_KARYAWAN, a.NAMA_KARYAWAN, b.ID_DEP_DIV_JAB, d.ID_DEPARTMENT, d.NAMA_DEPARTMENT, e.ID_JABATAN,
    e.NAMA_JABATAN, f.ID_DIVISI, f.NAMA_DIVISI
FROM data_karyawan as a, 
    relasi_div_jab_din as b,
    dep_divisi_jabatan as c,
    data_department as d,
    data_jabatan as e,
    data_divisi as f
WHERE 
    a.KODE_KARYAWAN=b.KODE_KARYAWAN
    AND b.ID_DEP_DIV_JAB=c.ID_DEP_DIV_JAB
    AND c.ID_DEPARTMENT=d.ID_DEPARTMENT
    AND c.ID_JABATAN=e.ID_JABATAN
    AND c.ID_DIVISI=f.ID_DIVISI
    $sql_dep
	AND a.KODE_KARYAWAN!='$karyID'
    AND a.KODE_KARYAWAN IN (
        SELECT b.KODE_KARYAWAN
        FROM nilai_per_penilai as a, nilai_akhir as b
        WHERE a.KODE_DINILAI=b.KODE_DINILAI 
            AND a.ID_BOBOT_LEVEL='$bobotlvID'
            AND a.KODE_PENILAI!='$penilaiID'
            AND b.ID_PERIODE='$periodeID')";
//echo $sql;
$qq = mysql_query($sql);

//load karyawan
$data = array();
$z=0;
$dataCount=0;
while ($row = mysql_fetch_assoc($qq)):
	//load data nilai_akhir 
	$dinilai = mysql_fetch_assoc( nilaiAkhir_load($row['KODE_KARYAWAN'], $row['ID_DEP_DIV_JAB'], $periodeID) );
	
	//load nilai_per_penilai, cek apakah sudah ada datanya. jika ada, checkbox state checked
	$npp = mysql_fetch_assoc(npp_loadComplete(
			"a.KODE_DINILAI='".$dinilai['KODE_DINILAI']."' AND a.ID_BOBOT_LEVEL='".$bobotlvID."'"));

	//load nama karyawan penilainya sapa
	$kary = mysql_fetch_assoc(kary_load($npp['KODE_KARYAWAN_PENILAI'])); 
?>
<tr <?=tag_zebra($z++)?>>
	<td><?=$row['NAMA_KARYAWAN']?></td>
	<td align="left"><?=$row['NAMA_JABATAN']?></td>
	<td align="left"><?=$row['NAMA_DIVISI']?></td>
	<td align="left"><?=$row['NAMA_DEPARTMENT']?></td>
	<td align="left"><?=$kary['NAMA_KARYAWAN']?></td>
</tr>
<?php $dataCount++; ?>
<?php endwhile;?>


<?php if ($dataCount <=0): ?>			
<tr <?=tag_zebra($z++)?>><td colspan="5" align="center"><h3><span>No data</span></h3></td></tr>
<?php endif;?>