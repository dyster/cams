<?=$this->form->create($ticket); ?>
<?=$this->form->field('title', array('label' => 'Titel')); ?>
<?=$this->form->field('type', array('type' => 'select','list' => array('BUG' => "Bugg",'enhancement' => "Förbättring","TODO" => "TODO"), 'label' => 'Typ'));?>
<label>Text</label>
<?=$this->form->textarea('text'); ?>
<?=$this->form->field('module', array('label' => 'Modul')); ?>
<?=$this->form->submit('Skapa Ticket'); ?>
<?=$this->form->end(); ?>

