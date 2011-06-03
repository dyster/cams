<?php echo $this->form->create($user); ?>
<?php echo $this->form->field('password', array('type' => 'password')); ?>
<?php echo $this->form->submit('Ändra'); ?>
<?php echo $this->form->end(); ?>