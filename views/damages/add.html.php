<?php use cams\models\Damages; ?>
<?=$this->form->create($damage); ?>
<?=$this->form->field('short', array('label' => 'Skadetext')); ?>
<label>Fritext</label>
<?=$this->form->textarea('notes'); ?>
<?=$this->form->field('prio', array('type' => 'select','list' => array(3 => "3 - Tages när fordonet står på verkstad",2 => "2 - Reparation måste åtgärdas nästa vst besök",1 => "1 - Körförbud, ej trafiksäker"), 'label' => 'Prio'));?>
<?=$this->form->field('code', array('type' => 'select','list' => Damages::getCodeArray(), 'label' => 'Skadekod'));?>
<?=$this->form->field('location', array('label' => 'Plats (vid körförbud)')); ?>
<?=$this->form->submit('Lägg till'); ?>
<?=$this->form->end(); ?>
