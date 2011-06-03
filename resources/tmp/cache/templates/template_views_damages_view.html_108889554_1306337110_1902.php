<?php use cams\models\Damages; ?>
<table>
<thead>
	<th>Littera</th><th><?php echo $h($type->name); ?></th>
</thead>
<thead>
	<th>Fordon</th><th><?php echo $h($object->name); ?></th>
</thead>
<tr>
	<td>Ägare</td><td><?php echo $h($owner->name); ?></td>
</tr>

</table>

<table>
		<thead>
			<th>Skada</th><th><?php echo $h($damage->short); ?></th>
		</thead>
		<tr>
			<td>Prio</td><td><?php echo $h($damage->prio); ?></td>
		</tr>
		<tr>
			<td>ID</td><td><?php echo $h($damage->id); ?></td>
		</tr>
		<tr>
			<td>Skadekod</td><td><?php echo $h(Damages::getCode($damage->code)); ?></td>
		</tr>
		<tr>
			<td>Fritext</td><td><span style="font-style: italic;"><?php echo $h($damage->notes); ?></span></td>
		</tr>
		<tr>
			<td>Skapad</td><td><?php echo $h(substr($damage->created, 0, 16)); ?> by <?php echo $h($damage->getCreatedBy()->fullname); ?></td>
		</tr>
		<?php if(strtotime($damage->modified) > 0) echo "<tr><td>Ändrad</td><td> ".substr($damage->modified, 0 ,16)." by {$damage->getModifiedBy()->fullname}</td></tr>"; ?> 
		<tr>
			<td>Kvitterad</td><td><?php echo $h($damage->active?"Nej":"Ja, ".substr($damage->nulled, 0, 16) . " av " . $damage->getNulledBy()->fullname); ?></td>
		</tr>
		<?php echo $damage->active?"":"<tr><td>Åtgärd</td><td>{$damage->nulltext}</td></tr>";?>
		
	</table>

<ul>
		<li style="display: inline;"><?php echo $this->html->link('Ändra', '/damages/edit/'.$damage->id, array('class' => 'knapp')); ?></li>  
		<li style="display: inline;"><?php echo $this->html->link('Kvittera', '/damages/nullify/'.$damage->id, array('class' => 'knapp')); ?></li>
	</ul>
	
<?php if(count($logs) > 0) { ?>
<table>
	<thead>
		<tr>
			<th colspan="2">Uppdateringar</th>
		</tr>
	</thead>
	<?php foreach($logs as $log) { ?>
	<tr>
		<td><?php echo $h(substr($log->created,0, 16)); ?></td><td><?php echo $h($log->field); ?> <strong>ändrades från</strong> <?php echo $h($log->from); ?> <strong>till</strong> <?php echo $h($log->to); ?> <strong>av</strong> <?php echo $h($log->getUser()->fullname); ?></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
