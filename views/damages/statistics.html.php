<h2>Topp tio</h2>
<table>
	<thead>
		<tr>
			<th>Skador</th><th>Typ</th><th>Nr</th><th>Ägare</th>
		</tr>
	</thead>
<?php foreach ($objectDist as $key => $val) 
{ $object = cams\models\Objects::first($key) ?>
	<tr>
    	<td><?=$objectDist[$object->id];?></td><td><?=$object->getType()->name; ?></td><td><?=$this->html->link($object->name, 'objects/view/'.$object->id);?></td><td><?=$object->getOwner()->name; ?></td>
    </tr>
<?php } ?>
</table>

<h2>Skadefördelning</h2>
<table>
	<thead>
		<tr>
			<th>Kod</th><th>%</th><th>Totalt</th>
		</tr>
	</thead>
<?php foreach ($groups as $group) 
{ ?>
	<tr>
    	<td><?=$group[0];?></td><td><?=ceil($group[1]);?></td><td><?=$group[2];?></td>
    </tr>
<?php } ?>
</table>


