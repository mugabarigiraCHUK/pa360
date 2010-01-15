<?php $rsjab = RELASIJABATAN_load($karyID)?>
<?php while ($row = mysql_fetch_assoc($rsjab)):?>
<option value="<?=$row['ID_DEP_DIV_JAB']?>" divisi="<?=$row['NAMA_DIVISI']?>" departemen="<?=$row['NAMA_DEPARTMENT']?>"><?=$row['NAMA_JABATAN']?></option>
<?php endwhile;?>
