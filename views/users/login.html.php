<?=$this->form->create(null); ?>
<?=$this->form->field('username', array('label' => 'Användarnamn')); ?>
<?=$this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?=$this->form->submit('Logga in'); ?>
<?=$this->form->end(); ?>
