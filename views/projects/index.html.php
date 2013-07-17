<?php
use lithium\security\Auth;
use cams\models\acls;
$authz = Auth::check('user');
$canEdit = acls::getAllowedAction($authz['id'], 'projects', 'edit');
$canDelete = acls::getAllowedAction($authz['id'], 'projects', 'delete');
?>


<table>
	<thead>
		<th width="50">OrderNr</th>
		<th width="30">Litt.</th>
		<th width="50">Fordon</th>
		<th>Ort</th>
		<th>Beskrivning</th>
		<?php if($canEdit) { ?> <th width="50">Ändra</th> <?php } ?>
		<?php if($canDelete) { ?> <th width="50">Radera</th> <?php } ?>
	</thead>
	<tbody>
<?php foreach($projects as $p){ ?>
	<tr>
		<td style="background-color: <?=$p->colour;?>"><?=$this->html->link($p->project_nr, '/projects/view/'.$p->id);?></td>
		<td><?=$p->typ;?></td>
		<td><?=$p->fordon;?></td>
		<td><?=$p->ort;?></td>
		<td><?=$this->html->link($p->description, '/projects/view/'.$p->id);?></td>
		<?php if($canEdit) { ?> <td><?=$this->html->link('Ändra', '/projects/edit/'.$p->id);?></td> <?php } ?>
		<?php if($canDelete) { ?> <td><?=$this->html->link('Radera', '/projects/delete/'.$p->id);?></td> <?php } ?>
	</tr>
<?php } ?>
	</tbody>
</table>


