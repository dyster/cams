<table>
	<thead>
		<tr>
			<th>Fordon</th><th>Noteringar</th>
		</tr>
	</thead>
	<?php foreach($objects as $object) { ?>
	<tr>
		<td><?php echo $this->html->link($object->toString(), 'objects/view/'.$object->id); ?></td><td><?php echo $h($object->notes); ?></td>
	</tr>
	<?php } ?>
</table>
