<table>
	<tr>
		<td>Skadetext</td><td><?php echo $h($damage->short); ?></td>
	</tr>
	<tr>
		<td>Prio</td><td><?php echo $h($damage->prio); ?></td>
	</tr>
	<tr>
		<td>Fritext</td><td><?php echo $h($damage->notes); ?></td>
	</tr>
	<tr>
		<td>Skapad</td><td><?php echo $h(substr($damage->created, 0 , 16)); ?></td>
	</tr>
	<tr>
		<td>Skapad av</td><td><?php echo $h($damage->getCreatedBy()->fullname); ?></td>
	</tr>
</table>
<?php echo $this->form->create($damage); ?>
<label>Åtgärd</label>
<?php echo $this->form->textarea('nulltext'); ?>
<?php echo $this->form->submit('Kvittera'); ?>
<?php echo $this->form->end(); ?>