<table>
	<tr>
		<td>Username</td><td><?php echo $h($user->username); ?></td>
	</tr>
	<tr>
		<td>User ID</td><td><?php echo $h($user->id); ?></td>
	</tr>
</table>

<?php echo $this->form->create($user); ?>
<?php echo $this->form->field('fullname', array('label' => 'Fullständigt namn')); ?>
<?php echo $this->form->field('email', array('label' => 'E-mail')); ?>
<?php echo $this->form->field('phone', array('label' => 'Telefon')); ?>
<?php echo $this->form->field('mobile', array('label' => 'Mobil')); ?>
<?php echo $this->form->submit('Ändra'); ?>
<?php echo $this->form->end(); ?>


