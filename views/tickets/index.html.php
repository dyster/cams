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
		<td><?=$ticket->id;?></td>
		<td><?=$this->html->link($ticket->title, '/tickets/view/'.$ticket->id);?></td>
		<td><?=$ticket->type;?></td>
		<td><?=$ticket->prio;?></td>
		<td><?=$ticket->getCreatedBy()->fullname;?></td>
		<td><?=$ticket->created;?></td>
		<td><?=$ticket->module;?></td>
		<td>[<?=$this->html->link('Edit', '/tickets/edit/'.$ticket->id);?>]</td>
		<td><?php $c = $ticket->getCommentsCount();?>
		<?php if($c > 0) echo $this->html->link($c . ' [Läs]', '/tickets/view/'.$ticket->id); ?></td>
	</tr>
	<?php } ?>
</table>