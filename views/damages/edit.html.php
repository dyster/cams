<?php use cams\models\Damages; ?>
<?=$this->form->create($damage); ?>
<?=$this->form->field('short', array('label' => 'Beskrivning')); ?>
<label>Noteringar</label>
<?=$this->form->textarea('notes'); ?>
<?=$this->form->field('prio', array('type' => 'select','list' => array(1 => 1,2 => 2,3 => 3), 'label' => 'Prio'));?>
<?=$this->form->field('code', array('type' => 'select','list' => Damages::getCodeArray(), 'label' => 'Skadekod'));?>
<?=$this->form->field('location', array('label' => 'Plats')); ?>
<?=$this->form->submit('Uppdatera'); ?>
<?=$this->form->end(); ?>

