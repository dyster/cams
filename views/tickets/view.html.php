<table>
	<tr>
		<td>Titel</td><td><?=$ticket->title;?></td>
	</tr>
	<tr>
		<td>Text</td><td><?=$ticket->text;?></td>
	</tr>
	<tr>
		<td>Skapad av</td><td><?=$ticket->getCreatedBy()->fullname;?></td>
	</tr>
	<tr>
		<td>Modul</td><td><?=$ticket->module;?></td>
	</tr>
	<tr>
		<td>Skapad</td><td><?=substr($ticket->created, 0, 16);?></td>
	</tr>
</table>
<?php if($ticket->user_id == $_SESSION['user']['id']) { ?>
<ul>
	<li style="display: inline;"><?=$this->html->link('Avsluta ärendet', '/tickets/delete/'.$ticket->id, array('class' => 'knapp'));?></li>
</ul>
<?php } ?>
<table>
	<thead>
	<tr>
		<th colspan="2">Kommentarer</th>
	</tr>
	</thead>
	<?php foreach($comments as $com) { ?>
	<tr>
		<td><?=$com->post;?></td><td><?=$com->getCreatedBy()->fullname;?> <?=substr($com->created, 0, 16);?></td>
	</tr>
	<?php } ?>
	
</table>
<?=$this->form->create($comment); ?>
<label>Kommentar</label>
<?=$this->form->textarea('post'); ?>
<?=$this->form->submit('Lägg till'); ?>
<?=$this->form->end(); ?>

<table>
	<thead>
	<tr>
		<th colspan="2">Uppdateringar</th>
	</tr>
	</thead>
<?php foreach($logs as $log) { ?>
	<tr>
		<td><?=substr($log->created,0, 16);?></td><td><?=$log->field;?> <strong>ändrades från</strong> <?=$log->from;?> <strong>till</strong> <?=$log->to;?> <strong>av</strong> <?=$log->getUser()->fullname;?></td>
	</tr>
<?php } ?>
</table>
