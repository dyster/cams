<?php echo $this->form->create($object); ?>
<?php echo $this->form->field('name', array('label' => 'Nummer')); ?>
<?php echo $this->form->field('owner_id', array('type' => 'select','list' => $owners, 'label' => 'Ägare')); ?>
<?php echo $this->form->field('type_id', array('type' => 'select','list' => $types, 'label' => 'Fordonstyp')); ?>
<label>Noteringar</label>
<?php echo $this->form->textarea('notes'); ?>
<?php echo $this->form->submit('Lägg till'); ?>
<?php echo $this->form->end(); ?>