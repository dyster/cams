<table>
	<tr>
		<td>Username</td><td><?=$user->username;?></td>
	</tr>
	<tr>
		<td>User ID</td><td><?=$user->id;?></td>
	</tr>
</table>

<?=$this->form->create($user); ?>
<?=$this->form->field('fullname', array('label' => 'Fullständigt namn')); ?>
<?=$this->form->field('email', array('label' => 'E-mail')); ?>
<?=$this->form->field('phone', array('label' => 'Telefon')); ?>
<?=$this->form->field('mobile', array('label' => 'Mobil')); ?>
<?=$this->form->submit('Ändra'); ?>
<?=$this->form->end(); ?>


