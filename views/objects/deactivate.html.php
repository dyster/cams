<p>När du avaktiverar detta fordon anses det inte längre vara i trafik och kommer <br /> således inte att synas längre och du måste maila en förfrågan om att återaktivera det.</p>
<p>För att avaktivera, byt värde till 0</p>
	
<?=$this->form->create($object); ?>
<?=$this->form->field('active', array('type' => 'select','list' => array(1 => 1, 0 => 0), 'label' => 'Aktivt Fordon'));?>
<?=$this->form->submit('Skicka'); ?>
<?=$this->form->end(); ?>

