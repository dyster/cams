<?php use cams\models\Damages; ?>
<?php echo $this->form->create($damage); ?>
<?php echo $this->form->field('short', array('label' => 'Skadetext')); ?>
<label>Fritext</label>
<?php echo $this->form->textarea('notes'); ?>
<?php echo $this->form->field('prio', array('type' => 'select','list' => array(3 => "3 - Tages när fordonet står på verkstad",2 => "2 - Reparation måste åtgärdas nästa vst besök",1 => "1 - Körförbud, ej trafiksäker"), 'label' => 'Prio')); ?>
<?php echo $this->form->field('code', array('type' => 'select','list' => Damages::getCodeArray(), 'label' => 'Skadekod')); ?>
<?php echo $this->form->field('location', array('label' => 'Plats (vid körförbud)')); ?>
<?php echo $this->form->submit('Lägg till'); ?>
<?php echo $this->form->end(); ?>
