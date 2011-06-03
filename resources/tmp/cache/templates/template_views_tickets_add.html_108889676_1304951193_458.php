<?php echo $this->form->create($ticket); ?>
<?php echo $this->form->field('title', array('label' => 'Titel')); ?>
<?php echo $this->form->field('type', array('type' => 'select','list' => array('BUG' => "Bugg",'enhancement' => "Förbättring","TODO" => "TODO"), 'label' => 'Typ')); ?>
<label>Text</label>
<?php echo $this->form->textarea('text'); ?>
<?php echo $this->form->field('module', array('label' => 'Modul')); ?>
<?php echo $this->form->submit('Skapa Ticket'); ?>
<?php echo $this->form->end(); ?>

