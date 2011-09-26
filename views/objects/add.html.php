<?=$this->form->create($object); ?>
<?=$this->form->field('name', array('label' => 'Nummer')); ?>
<?=$this->form->field('owner_id', array('type' => 'select','list' => $owners, 'label' => 'Ägare'));?>
<?=$this->form->field('type_id', array('type' => 'select','list' => $types, 'label' => 'Fordonstyp'));?>
<label>Noteringar</label>
<?=$this->form->textarea('notes'); ?>
<?=$this->form->field('group', array('label' => 'Grupp'));?>
<?=$this->form->submit('Lägg till'); ?>
<?=$this->form->end(); ?>