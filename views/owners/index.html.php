<table>
	<thead>
		<tr>
			<th>Kort</th><th>Namn</th>
		</tr>
	</thead>
	<?php foreach($owners as $owner) { ?>
	<tr>
		<td><?=$this->html->link($owner->short, 'owners/view/'.$owner->id);?></td><td><?=$this->html->link($owner->name, 'owners/view/'.$owner->id);?></td>
	</tr>
	<?php } ?>
</table>