<table>
	<tr>
		<td>Username</td><td><?=$user->username;?></td>
	</tr>
	<tr>
		<td>User ID</td><td><?=$user->id;?></td>
	</tr>
</table>

<?=$this->form->create($user); ?>
<?=$this->form->field('username'); ?>
<?=$this->form->field('fullname'); ?>
<?=$this->form->submit('Ändra'); ?>
<?=$this->form->end(); ?>

<h2>Användarrättigheter</h2>
<table>
	<thead>
		<th>Controller</th><th>Action</th><th>Permission</th><th>Change</th>
	</thead>
	<?php foreach($acos as $aco) { ?>
	<tr>
		<td><?=$aco->controller;?></td>
		<td><?=$aco->action;?></td>
		<td><?php if(in_array($aco->id, $allowed)) {echo '<span class="strong green">Allowed</span>';} else echo '<span class="strong red">Denied</span>'; ?></td>
		<td><?=$this->html->link("Flip", "/users/flip/{$aco->id}/{$user->id}");?></td>
	</tr>
	<?php } ?>
</table>

<h2>Publika - tillgängliga för all</h2>
<table>
	<thead>
		<th>Controller</th><th>Action</th>
	</thead>
	<?php foreach($publicacos as $aco) { ?>
	<tr>
		<td><?=$aco->controller;?></td>
		<td><?=$aco->action;?></td>
	</tr>
	<?php } ?>
</table>

<h2>Standard - tillgängliga för alla inloggade</h2>
<table>
	<thead>
		<th>Controller</th><th>Action</th>
	</thead>
	<?php foreach($defaultacos as $aco) { ?>
	<tr>
		<td><?=$aco->controller;?></td>
		<td><?=$aco->action;?></td>
	</tr>
	<?php } ?>
</table>
