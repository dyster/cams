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

<h2>Ändra lösenord</h2>

<?=$this->form->create(); ?>
<?=$this->form->field('oldpassword', array('type' => 'password', 'label' => 'Nuvarande Lösenord')); ?>
<?=$this->form->field('password1', array('type' => 'password', 'label' => 'Nytt Lösenord')); ?>
<?=$this->form->field('password2', array('type' => 'password', 'label' => 'Skriv igen')); ?>
<?=$this->form->submit('Ändra Lösenord'); ?>
<?=$this->form->end(); ?>


