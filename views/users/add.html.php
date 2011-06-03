<?=$this->form->create($user); ?>
<?=$this->form->field('username', array('label' => 'Användarnamn')); ?>
<?=$this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?=$this->form->field('fullname', array('label' => 'Fullständigt namn')); ?>
<?=$this->form->field('email', array('label' => 'Email')); ?>
<?=$this->form->submit('Skapa'); ?>
<?=$this->form->end(); ?>
<pre>
<?php
use cams\models\Owners;
//$own = Owners::all();
$own = Owners::find('all', array('fields' => array('short') ));
//foreach($own as $o)
//	print_r($o->short);
//print_r($own->data());
print_r($own->data());
print_r($own->to('array'));

?>
</pre>
