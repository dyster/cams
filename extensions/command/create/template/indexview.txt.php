<?php $data = ${:plural}->to('array'); ?>


<table>
	<thead>
		<tr>
			<?php foreach($data[1] as $key => $val) echo "<th>$key</th>"; ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach($data as $row) { ?>
		<tr>
			<?php foreach($row as $val) echo "<td>$val</td>"; ?>
		</tr>
		<?php } ?>
	</tbody>
</table>
