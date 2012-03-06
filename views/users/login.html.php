<?=$this->form->create(null, array('class' => 'login')); ?>
<?=$this->form->field('username', array('label' => 'Användarnamn')); ?>
<?=$this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?=$this->form->submit('Logga in'); ?>
<?=$this->form->end(); ?>

<div id="grayness"></div>