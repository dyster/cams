<?php use cams\models\Damages; ?>
<?php echo $this->form->create($damage); ?>
<?php echo $this->form->field('short', array('label' => 'Beskrivning')); ?>
<label>Noteringar</label>
<?php echo $this->form->textarea('notes'); ?>
<?php echo $this->form->field('prio', array('type' => 'select','list' => array(1 => 1,2 => 2,3 => 3), 'label' => 'Prio')); ?>
<?php echo $this->form->field('code', array('type' => 'select','list' => Damages::getCodeArray(), 'label' => 'Skadekod')); ?>
<?php echo $this->form->field('location', array('label' => 'Plats (vid körförbud)')); ?>
<?php echo $this->form->submit('Uppdatera'); ?>
<?php echo $this->form->end(); ?>

