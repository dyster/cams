<table>
<thead>
	<th>Littera</th><th><?=$type->name; ?></th>
</thead>
<thead>
	<th>Fordon</th><th><?=$object->name; ?></th>
</thead>
<tr>
	<td>Typinfo</td><td><?=$type->notes;?></td>
</tr>
<tr>
	<td>Ägare</td><td><?=$owner->name;?></td>
</tr>
<tr>
	<td>Noteringar</td><td><?=$object->notes;?></td>
</tr>
<tr>
	<td>Grupp</td><td><?=$object->group;?></td>
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
		<?php echo '<li style="display: inline;">'.$this->html->link('Statistik', '/objects/statistics/'.$object->id, array('class' => 'knapp')).'</li>'; ?>
	</ul>

<!--<?=$this->html->link('Lägg till hjulmått', '/wheeldims/add/'.$object->id);?>-->

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
			<th>Skada</th><th><?=$damage->short;?></th>
		</thead>
		<tr>
			<td>Prio</td><td><?=$damage->prio;?></td>
		</tr>
		<tr>
			<td>Plats</td><td><?=$damage->location;?></td>
		</tr>
		<tr>
			<td>Fritext</td><td><span style="font-style: italic;"><?=$damage->notes;?></span></td>
		</tr>
		<tr>
			<td>Skapad</td><td><?=substr($damage->created, 0, 16);?> by <?=$damage->getCreatedBy()->fullname;?></td>
		</tr>
		<?php if($damage->modifiedby > 0) echo "<tr><td>Ändrad</td><td> ".substr($damage->modified, 0 ,16)." av {$damage->getModifiedBy()->fullname}</td></tr>"; ?>
		
		
		
	</table>
	<ul>
		<li style="display: inline;"><?=$this->html->link('Gå till', '/damages/view/'.$damage->id, array('class' => 'knapp'));?></li>
		<li style="display: inline;"><?=$this->html->link('Ändra', '/damages/edit/'.$damage->id, array('class' => 'knapp'));?></li>  
		<li style="display: inline;"><?=$this->html->link('Kvittera', '/damages/nullify/'.$damage->id, array('class' => 'knapp'));?></li>
	</ul>
	</div>
	<!--
	<div class="buttonbox shadow">
		
		<h4><?=$damage->short;?></h4>
		<code><?=$damage->notes;?></code>
		<p>Created <?=$damage->created;?> by <?=$damage->getCreatedBy()->fullname;?></p>
		<?php if(strtotime($damage->modified) > 0) echo "<p>Modified {$damage->modified} by {$damage->getModifiedBy()->fullname}</p>"; ?> 
		<ul>
		    	<li><?=$this->html->link('Edit', '/damages/edit/'.$damage->id);?></li><li><?=$this->html->link('Nullify', '/damages/nullify');?></li>
		</ul>
	</div> -->
<?php } ?> 	



