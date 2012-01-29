<?php
$model = $usershift->model();
$schema = $model::schema();
?>


<?=$this->form->create($usershift); ?>

<?php foreach($schema as $field => $info) 
{
	if($field == 'id')
		continue;
	switch ($info['type']) {
		case 'string':
			if($info['length'] > 100)
				echo "<label>$field</label>" . $this->form->textarea($field);
			else
				echo $this->form->field($field);
			break;
		
		default:
			echo $this->form->field($field);
			break;
	}
} ?>
<?=$this->form->submit('Edit'); ?>
<?=$this->form->end(); ?>