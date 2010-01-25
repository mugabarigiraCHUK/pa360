<?php $rsjab = RELASIJABATAN_load($karyID)?>
<?php while ($row = mysql_fetch_assoc($rsjab)):?>
<option value="<?=$row['ID_DEP_DIV_JAB']?>" divisi="<?=$row['NAMA_DIVISI']?>" 
		departemen="<?=$row['NAMA_DEPARTMENT']?>" 
		departemenID="<?=$row['ID_DEPARTMENT']?>" 
		<?=$dep_div_jabID===$row['ID_DEP_DIV_JAB']?"selected=\"selected\"":""?>>
			<?=$row['NAMA_JABATAN']?>
</option>
<?php endwhile;?>