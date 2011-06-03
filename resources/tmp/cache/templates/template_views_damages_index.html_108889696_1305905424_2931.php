<?php  $antal = array(10, 20, 40, 60, 100); ?>

<h2>Senast inlagda skador</h2>
<table>
	<thead>
		<tr>
			<th>Inlagd</th><th>Fordon</th><th>Skada</th><th>Prio</th><th>Inlagd av</th>
		</tr>
	</thead>
	<?php foreach($damages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?php echo $h(substr($damage->created, 0, 16)); ?></td>
		<td> <?php echo $this->html->link($object->toString(), 'objects/view/'.$object->id); ?></td>
		<td><?php echo $this->html->link($damage->short, 'damages/view/'.$damage->id); ?></td>
		<td style="<?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break; // gul = #fbf678
		default: echo ''; break;
	} ?>"><?php echo $h($damage->prio); ?></td>
		<td><?php echo $h($damage->getCreatedBy()->fullname); ?></td>
	</tr>	
	<?php } ?>
	<tfoot>
		<tr><td colspan="5">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/$a/20/20").' '; ?></td></tr>
	</tfoot>	
</table>

<h2>Senast ändrade skador</h2>

<table>
	<thead>
		<tr>
			<th>Inlagd</th><th>Fordon</th><th>Skada</th><th>Prio</th><th>Ändrad av</th>
		</tr>
	</thead>
	<?php foreach($modifieddamages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?php echo $h(substr($damage->created, 0, 16)); ?></td>
		<td> <?php echo $this->html->link($object->toString(), 'objects/view/'.$object->id); ?></td>
		<td><?php echo $this->html->link($damage->short, 'damages/view/'.$damage->id); ?></td>
		<td style="<?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break;
		default: echo ''; break;
	} ?>"><?php echo $h($damage->prio); ?></td>
		<td><?php echo $h($damage->getModifiedBy()->fullname); ?></td>
	</tr>	
	<?php } ?>	
	<tfoot>
		<tr><td colspan="5">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/20/$a/20").' '; ?></td></tr>
	</tfoot>
</table>

<h2>Senast kvitterade skador</h2>

<table>
	<thead>
		<tr>
			<th>Inlagd</th><th>Fordon</th><th>Skada</th><th>Prio</th><th>Kvitterad</th><th>Av</th>
		</tr>
	</thead>
	<?php foreach($nulleddamages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?php echo $h(substr($damage->created, 0, 16)); ?></td>
		<!--<td><?php echo $h((strtotime($damage->modified) > 0)?$damage->modified:"N/A"); ?></td>-->
		<td> <?php echo $this->html->link($object->toString(), 'objects/view/'.$object->id); ?></td>
		<td><?php echo $this->html->link($damage->short, 'damages/view/'.$damage->id); ?></td>
		<td style="<?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break;
		default: echo ''; break;
	} ?>"><?php echo $h($damage->prio); ?></td>
		<td><?php echo $h(substr($damage->nulled, 0, 16)); ?></td>
		<td><?php echo $h($damage->getNulledBy()->fullname); ?></td>
	</tr>	
	<?php } ?>	
	<tfoot>
		<tr><td colspan="6">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/20/20/$a").' '; ?></td></tr>
	</tfoot>
</table>

