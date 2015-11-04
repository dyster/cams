<?php use cams\models\Damages; ?>
<table>
<thead>
	<th>Littera</th><th><?=$type->name; ?></th>
</thead>
<thead>
	<th>Fordon</th><th><?=$object->name; ?></th>
</thead>
<tr>
	<td>Ägare</td><td><?=$owner->name;?></td>
</tr>

</table>

<table>
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
			<td>ID</td><td><?=$damage->id;?></td>
		</tr>
		<tr>
			<td>Skadekod</td><td><?=Damages::getCode($damage->code);?></td>
		</tr>
		<tr>
			<td>Fritext</td><td><span style="font-style: italic;"><?=$damage->notes;?></span></td>
		</tr>
		<tr>
			<td>Skapad</td><td><?=substr($damage->created, 0, 16);?> by <?=$damage->getCreatedBy()->fullname;?></td>
		</tr>
		<?php if($damage->modifiedby > 0) echo "<tr><td>Ändrad</td><td> ".substr($damage->modified, 0 ,16)." by {$damage->getModifiedBy()->fullname}</td></tr>"; ?>
		<tr>
			<td>Kvitterad</td><td><?=$damage->active?"Nej":"Ja, ".substr($damage->nulled, 0, 16) . " av " . $damage->getNulledBy()->fullname;?></td>
		</tr>
		<?php echo $damage->active?"":"<tr><td>Åtgärd</td><td>{$damage->nulltext}</td></tr>";?>
		
	</table>

<ul>
		<li style="display: inline;"><?=$this->html->link('Ändra', '/damages/edit/'.$damage->id, array('class' => 'knapp'));?></li>  
		<li style="display: inline;"><?=$this->html->link('Kvittera', '/damages/nullify/'.$damage->id, array('class' => 'knapp'));?></li>
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
		<td><?=substr($log->created,0, 16);?></td><td><?=$log->field;?> <strong>ändrades från</strong> <?=$log->from;?> <strong>till</strong> <?=$log->to;?> <strong>av</strong> <?=$log->getUser()->fullname;?></td>
	</tr>
	<?php } ?>
</table>
<?php } ?>
