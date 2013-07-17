<?php  $antal = array(10, 20, 40, 60, 100); ?>

<h2>Senast inlagda skador</h2>
<table>
	<thead>
		<tr>
			<th style="width: 20px;">ID</th><th style="width: 110px;">Inlagd</th><th style="width: 20px;">Prio</th><th style="width: 150px;">Fordon</th><th style="width: 20px;">Grupp</th><th>Skada</th><th style="width: 120px;">Inlagd av</th>
		</tr>
	</thead>
	<?php foreach($damages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?=$damage->id;?></td>
		<td><?=substr($damage->created, 0, 16);?></td>
		<td style="text-align: center; <?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break; // gul = #fbf678
		default: echo ''; break;
	} ?>"><?=$damage->prio;?></td>
		<td> <?=$this->html->link($object->toString(), 'objects::view'.$object->id);?></td>
		<td><?=$object->group;?></td>
		<td><?=$this->html->link($damage->short, 'damages::view'.$damage->id);?></td>
		<td><?=$damage->getCreatedBy()->fullname;?></td>
	</tr>
	<?php } ?>
	<tfoot>
		<tr><td colspan="7">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/$a/10/10").' '; ?></td></tr>
	</tfoot>
</table>

<h2>Senast kvitterade skador</h2>

<table>
	<thead>
		<tr>
			<th style="width: 20px;">ID</th><th style="width: 110px;">Kvitterad</th><th style="width: 20px;">Prio</th><th style="width: 150px;">Fordon</th><th style="width: 20px;">Grupp</th><th>Skada</th><th style="width: 120px;">Av</th>
		</tr>
	</thead>
	<?php foreach($nulleddamages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?=$damage->id;?></td>
		<td><?=substr($damage->nulled, 0, 16);?></td>
		<td style="text-align: center; <?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break;
		default: echo ''; break;
	} ?>"><?=$damage->prio;?></td>
		<!--<td><?=(strtotime($damage->modified) > 0)?$damage->modified:"N/A";?></td>-->
		<td> <?=$this->html->link($object->toString(), 'objects::view'.$object->id);?></td>
		<td><?=$object->group;?></td>
		<td><?=$this->html->link($damage->short, 'damages::view'.$damage->id);?></td>


		<td><?=$damage->getNulledBy()->fullname;?></td>
	</tr>
	<?php } ?>
	<tfoot>
		<tr><td colspan="7">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/10/10/$a").' '; ?></td></tr>
	</tfoot>
</table>


<h2>Senast ändrade skador</h2>

<table>
	<thead>
		<tr>
			<th style="width: 20px;">ID</th><th style="width: 110px;">Inlagd</th><th style="width: 20px;">Prio</th><th style="width: 150px;">Fordon</th><th style="width: 20px;">Grupp</th><th>Skada</th><th style="width: 120px;">Ändrad av</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($modifieddamages as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?=$damage->id;?></td>
		<td><?=substr($damage->created, 0, 16);?></td>
		<td style="text-align: center; <?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break;
		default: echo ''; break;
	} ?>"><?=$damage->prio;?></td>
		<td> <?=$this->html->link($object->toString(), 'objects::view'.$object->id);?></td>
		<td><?=$object->group;?></td>
		<td><?=$this->html->link($damage->short, 'damages::view'.$damage->id);?></td>

		<td><?=$damage->getModifiedBy()->fullname;?></td>
	</tr>
	<?php } ?>
	</tbody>
	<tfoot>
		<tr><td colspan="7">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/damages/index/10/$a/10").' '; ?></td></tr>
	</tfoot>
</table>

