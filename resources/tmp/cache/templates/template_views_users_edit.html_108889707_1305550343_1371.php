<table>
	<tr>
		<td>Username</td><td><?php echo $h($user->username); ?></td>
	</tr>
	<tr>
		<td>User ID</td><td><?php echo $h($user->id); ?></td>
	</tr>
</table>

<?php echo $this->form->create($user); ?>
<?php echo $this->form->field('username'); ?>
<?php echo $this->form->field('fullname'); ?>
<?php echo $this->form->submit('Ändra'); ?>
<?php echo $this->form->end(); ?>

<h2>Användarrättigheter</h2>
<table>
	<thead>
		<th>Controller</th><th>Action</th><th>Permission</th><th>Change</th>
	</thead>
	<?php foreach($acos as $aco) { ?>
	<tr>
		<td><?php echo $h($aco->controller); ?></td>
		<td><?php echo $h($aco->action); ?></td>
		<td><?php if(in_array($aco->id, $allowed)) {echo '<span class="strong green">Allowed</span>';} else echo '<span class="strong red">Denied</span>'; ?></td>
		<td><?php echo $this->html->link("Flip", "/users/flip/{$aco->id}/{$user->id}"); ?></td>
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
		<td><?php echo $h($aco->controller); ?></td>
		<td><?php echo $h($aco->action); ?></td>
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
		<td><?php echo $h($aco->controller); ?></td>
		<td><?php echo $h($aco->action); ?></td>
	</tr>
	<?php } ?>
</table>
