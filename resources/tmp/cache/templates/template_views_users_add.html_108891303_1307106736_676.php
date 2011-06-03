<?php echo $this->form->create($user); ?>
<?php echo $this->form->field('username', array('label' => 'Användarnamn')); ?>
<?php echo $this->form->field('password', array('type' => 'password', 'label' => 'Lösenord')); ?>
<?php echo $this->form->field('fullname', array('label' => 'Fullständigt namn')); ?>
<?php echo $this->form->field('email', array('label' => 'Email')); ?>
<?php echo $this->form->submit('Skapa'); ?>
<?php echo $this->form->end(); ?>
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
