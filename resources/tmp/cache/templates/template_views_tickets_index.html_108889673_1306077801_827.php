<?php $cols = array('id'); ?>
<h2>Öppna tickets</h2>
<table>
	<thead>
		<tr>
			<th>#</th><th>Title</th><th>Type</th><th>Prio</th><th>Reporter</th><th>Created</th><th>Module</th><th></th><th>Comments</th>
		</tr>
	</thead>
	<?php foreach($tickets as $ticket) { ?>
	<tr>
		<td><?php echo $h($ticket->id); ?></td>
		<td><?php echo $this->html->link($ticket->title, 'tickets/view/'.$ticket->id); ?></td>
		<td><?php echo $h($ticket->type); ?></td>
		<td><?php echo $h($ticket->prio); ?></td>
		<td><?php echo $h($ticket->getCreatedBy()->fullname); ?></td>
		<td><?php echo $h($ticket->created); ?></td>
		<td><?php echo $h($ticket->module); ?></td>
		<td>[<?php echo $this->html->link('Edit', 'tickets/edit/'.$ticket->id); ?>]</td>
		<td><?php $c = $ticket->getCommentsCount();?>
		<?php if($c > 0) echo $this->html->link($c . ' [Läs]', 'tickets/view/'.$ticket->id); ?></td>
	</tr>
	<?php } ?>
</table>