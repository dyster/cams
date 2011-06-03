<?php echo $this->form->create(null); ?>
<?php echo $this->form->field('username', array('label' => 'Användarnamn')); ?>
<?php echo $this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?php echo $this->form->submit('Logga in'); ?>
<?php echo $this->form->end(); ?>
