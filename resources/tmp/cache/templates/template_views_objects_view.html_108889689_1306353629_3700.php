<table>
<thead>
	<th>Littera</th><th><?php echo $h($type->name); ?></th>
</thead>
<thead>
	<th>Fordon</th><th><?php echo $h($object->name); ?></th>
</thead>
<tr>
	<td>Typinfo</td><td><?php echo $h($type->notes); ?></td>
</tr>
<tr>
	<td>Ägare</td><td><?php echo $h($owner->name); ?></td>
</tr>
<tr>
	<td>Noteringar</td><td><?php echo $h($object->notes); ?></td>
</tr>
<?php preg_match_all('/(\\d\\d) (\\d\\d) ([0-9]{4}) ([0-9]{3})-(\\d)/', $object->name, $result, PREG_PATTERN_ORDER);
 //print_r($result); 
 if(!$result[0])
 	echo '<tr><td colspan="2">Det här fordonet har inte ett giltigt nr</td></tr>'; ?>

</table>
<ul>	<?php use cams\models\acls; ?>
		<?php echo (acls::getAllowedAction($_SESSION['user']['id'], 'damages', 'add'))?'<li style="display: inline;">'.$this->html->link('Lägg till skada', '/damages/add/'.$object->id, array('class' => 'knapp')).'</li>':'' ?>
		<?php echo (acls::getAllowedAction($_SESSION['user']['id'], 'objects', 'edit'))?'<li style="display: inline;">'.$this->html->link('Ändra', '/objects/edit/'.$object->id, array('class' => 'knapp')).'</li>':'' ?>
		<?php echo (acls::getAllowedAction($_SESSION['user']['id'], 'objects', 'deactivate'))?'<li style="display: inline;">'.$this->html->link('Avaktivera', '/objects/deactivate/'.$object->id, array('class' => 'knapp')).'</li>':'' ?>
		<?php echo '<li style="display: inline;">'.$this->html->link('Arkiv', '/objects/archive/'.$object->id, array('class' => 'knapp')).'</li>'; ?>
	</ul>

<!--<?php echo $this->html->link('Lägg till hjulmått', '/wheeldims/add/'.$object->id); ?>-->

<?php if(isset($groups) && false == true) { ?>
<table>
	<thead>
		<tr>
			<th colspan="<?php echo $h(count($groups)); ?>">Skadedistribution</th>
		</tr>
	</thead>
	<tr>
		<?php foreach($groups as $val) echo '<td>'.$val[0].'</td>'; ?>
	</tr>
	<tr>
		<?php foreach($groups as $val) echo '<td>'.$val[1].'</td>'; ?>
	</tr>
</table>
<?php } ?>

<hr />

<?php foreach($damages as $damage) { ?>
	<div style="margin-bottom: 30px;">
	<table style="<?php switch($damage->prio)
	{
		case (1): echo 'border: solid 2px #fd8888;'; break;
		case (2): echo 'border: solid 2px #3bb9ff;'; break;
		//case (3): echo 'border: #ffffff;'; break;
		default: echo ''; break;
	} ?>">
		<thead>
			<th>Skada</th><th><?php echo $h($damage->short); ?></th>
		</thead>
		<tr>
			<td>Prio</td><td><?php echo $h($damage->prio); ?></td>
		</tr>
		<tr>
			<td>Fritext</td><td><span style="font-style: italic;"><?php echo $h($damage->notes); ?></span></td>
		</tr>
		<tr>
			<td>Skapad</td><td><?php echo $h(substr($damage->created, 0, 16)); ?> by <?php echo $h($damage->getCreatedBy()->fullname); ?></td>
		</tr>
		<?php if(strtotime($damage->modified) > 0) echo "<tr><td>Ändrad</td><td> ".substr($damage->modified, 0 ,16)." av {$damage->getModifiedBy()->fullname}</td></tr>"; ?> 
		
		
		
	</table>
	<ul>
		<li style="display: inline;"><?php echo $this->html->link('Gå till', '/damages/view/'.$damage->id, array('class' => 'knapp')); ?></li>
		<li style="display: inline;"><?php echo $this->html->link('Ändra', '/damages/edit/'.$damage->id, array('class' => 'knapp')); ?></li>  
		<li style="display: inline;"><?php echo $this->html->link('Kvittera', '/damages/nullify/'.$damage->id, array('class' => 'knapp')); ?></li>
	</ul>
	</div>
	<!--
	<div class="buttonbox shadow">
		
		<h4><?php echo $h($damage->short); ?></h4>
		<code><?php echo $h($damage->notes); ?></code>
		<p>Created <?php echo $h($damage->created); ?> by <?php echo $h($damage->getCreatedBy()->fullname); ?></p>
		<?php if(strtotime($damage->modified) > 0) echo "<p>Modified {$damage->modified} by {$damage->getModifiedBy()->fullname}</p>"; ?> 
		<ul>
		    	<li><?php echo $this->html->link('Edit', '/damages/edit/'.$damage->id); ?></li><li><?php echo $this->html->link('Nullify', '/damages/nullify'); ?></li>
		</ul>
	</div> -->
<?php } ?> 	



