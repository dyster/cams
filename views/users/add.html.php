<?=$this->form->create($user); ?>
<?=$this->form->field('username', array('label' => 'Användarnamn')); ?>
<?=$this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?=$this->form->field('fullname', array('label' => 'Fullständigt namn')); ?>
<?=$this->form->field('email', array('label' => 'Email')); ?>
<?=$this->form->submit('Skapa'); ?>
<?=$this->form->end(); ?>
