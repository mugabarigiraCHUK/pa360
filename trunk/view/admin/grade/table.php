<?php $res = grd_select($periodeID); ?>
<?php while ($row = mysql_fetch_assoc($res)) :?>
<tr <?php echo tag_zebra($z++)?>>
	<td align="center"><?php echo $row['GRD_NAME']?></td>
	<td align="center"><?php echo number_format($row['GRD_MIN'],2)?></td>
	<td align="center"><?php echo number_format($row['GRD_MAX'],2)?></td>
	<td align="right">
		<a class="padR5" onclick="edit('<?php echo $row['GRD_ID']?>', this)">edit</a>
		<a class="padR5" onclick="remove('<?php echo $row['GRD_ID']?>', this)">delete</a>
	</td>
</tr>
<?php endwhile;?>