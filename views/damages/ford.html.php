<?=$this->form->create();?>
<label>Klistra in</label>
<?=$this->form->textarea('paste'); ?>
<?=$this->form->submit(); ?>
<?=$this->form->end(); ?>

<pre>
    <?=print_r($out);?>
</pre>