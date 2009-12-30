<?php $result = kripen_select($key); ?>
<?php while ($row = mysql_fetch_assoc($result)): ?>
<tr>
	<td align="center">
		<input type="checkbox" name="checkbox" value="checkbox" onclick="bobotLevel_chooseKriteria_balancing(this)" /></td>
	<td><?=$row['ID_KRITERIA']?></td>
	<td><?=$row['NAMA_KRITERIA']?></td>
	<td align="center"><?=$row['BOBOT']?></td>
</tr>
<?php endwhile; ?>