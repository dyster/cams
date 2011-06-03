<?php echo $this->form->create($news); ?>
<label>Nyhet</label>
<?php echo $this->form->textarea('post'); ?>
<?php echo $this->form->submit('Skicka'); ?>
<?php echo $this->form->end(); ?>

