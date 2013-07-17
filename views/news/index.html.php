<h2>Nyheter</h2>

	<?php foreach($news as $new) { ?>
<table>
	<tr>
		<td><strong><?=$new->post;?></strong></td>
	</tr>
	<tfoot>
		<tr>
			<td><?=$new->getCreatedBy()->fullname;?> - <?=substr($new->created, 0, 16);?></td>
		</tr>
	</tfoot>
</table>
	<?php } ?>


<h2>Dina Tickets</h2>
<table>
	<thead>
		<tr>
			<th>#</th><th>Titel</th><th>Typ</th><th>Skapad</th><th>Kommentarer</th>
		</tr>
	</thead>
	<?php foreach($usertickets as $ticket) { ?>
	<tr>
		<td><?=$ticket->id;?></td>
		<td><?=$this->html->link($ticket->title, 'tickets::view'.$ticket->id);?></td>
		<td><?=$ticket->type;?></td>
		<td><?=substr($ticket->created, 0, 16);?></td>
		<?php $c = $ticket->getCommentsCount();?>
		<?php 
		if($c > 0)
		{
			$linktext = $c . ' [Läs] ';
			if($ticket->updated) $linktext .= ' ! Uppdaterad !';
			echo '<td>'.$this->html->link($linktext, 'tickets::view'.$ticket->id);
			echo '</td>';
		}  
		?>
	</tr>
	<?php } ?>
</table>
