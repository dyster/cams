<table>
	<tr>
		<td>Titel</td><td><?php echo $h($ticket->title); ?></td>
	</tr>
	<tr>
		<td>Text</td><td><?php echo $h($ticket->text); ?></td>
	</tr>
	<tr>
		<td>Skapad av</td><td><?php echo $h($ticket->getCreatedBy()->fullname); ?></td>
	</tr>
	<tr>
		<td>Modul</td><td><?php echo $h($ticket->module); ?></td>
	</tr>
	<tr>
		<td>Skapad</td><td><?php echo $h(substr($ticket->created, 0, 16)); ?></td>
	</tr>
</table>
<?php if($ticket->user_id == $_SESSION['user']['id']) { ?>
<ul>
	<li style="display: inline;"><?php echo $this->html->link('Avsluta ärendet', '/tickets/delete/'.$ticket->id, array('class' => 'knapp')); ?></li>
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
		<td><?php echo $h($com->post); ?></td><td><?php echo $h($com->getCreatedBy()->fullname); ?> <?php echo $h(substr($com->created, 0, 16)); ?></td>
	</tr>
	<?php } ?>
	
</table>
<?php echo $this->form->create($comment); ?>
<label>Kommentar</label>
<?php echo $this->form->textarea('post'); ?>
<?php echo $this->form->submit('Lägg till'); ?>
<?php echo $this->form->end(); ?>

<table>
	<thead>
	<tr>
		<th colspan="2">Uppdateringar</th>
	</tr>
	</thead>
<?php foreach($logs as $log) { ?>
	<tr>
		<td><?php echo $h(substr($log->created,0, 16)); ?></td><td><?php echo $h($log->field); ?> <strong>ändrades från</strong> <?php echo $h($log->from); ?> <strong>till</strong> <?php echo $h($log->to); ?> <strong>av</strong> <?php echo $h($log->getUser()->fullname); ?></td>
	</tr>
<?php } ?>
</table>
