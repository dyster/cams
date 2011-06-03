<?php if(isset($groups)) { ?>
<table>
	<thead>
		<tr>
			<th colspan="<?=count($groups)+1;?>">Skadedistribution</th>
		</tr>
	</thead>
	<tr>
		<th>Kod</th><?php foreach($groups as $val) echo '<td>'.$val[0].'</td>'; ?>
	</tr>
	<tr>
		<th>%</th><?php foreach($groups as $val) echo '<td>'.$val[1].'</td>'; ?>
	</tr>
	<tr>
		<th>Totalt</th><?php foreach($groups as $val) echo '<td>'.$val[2].'</td>'; ?>
	</tr>
</table>
<p>Det är lite fattigt med statistik just nu, men det kommer mera</p>
<?php } else {?>
<p>Inga skador = ingen statistik</p>
<?php } ?>