<p>När du avaktiverar detta fordon anses det inte längre vara i trafik och kommer <br /> således inte att synas längre och du måste maila en förfrågan om att återaktivera det.</p>
<p>För att avaktivera, byt värde till 0</p>
	
<?php echo $this->form->create($object); ?>
<?php echo $this->form->field('active', array('type' => 'select','list' => array(1 => 1, 0 => 0), 'label' => 'Aktivt Fordon')); ?>
<?php echo $this->form->submit('Skicka'); ?>
<?php echo $this->form->end(); ?>

