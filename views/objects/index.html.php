<?php  $antal = array(10, 20, 40, 60, 100); ?>
<?php if(isset($prioobjects)) { ?>
<h2>Fordon med körförbud</h2>
<table style="border: solid 2px #fd8888;">
	<thead>
		<tr>
			<th>Körförbud sedan</th><th>Plats</th><th>Typ</th><th>Nr</th><th>Ägare</th>
		</tr>
	</thead>
<?php foreach ($prioobjects as $object) 
{ ?>
	<tr>
    	<td><?=substr($object->getPrio1Date(),0,10);?></td><td><?=$object->getPrio1Location();?></td><td><?=$object->getType()->name; ?></td><td><?=$this->html->link($object->name, 'objects/view/'.$object->id);?></td><td><?=$object->getOwner()->name; ?></td>
    </tr>
<?php } ?>
	<tfoot>
		<tr><td colspan="5">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/objects/index/$a/20").' '; ?></td></tr>
	</tfoot>
</table>
<?php } ?>

<?php if(isset($objects)) { ?>
<h2>Senast inlagda fordon</h2>
<table>
	<thead>
		<tr>
			<th></th><th>Typ</th><th>Nr</th><th>Ägare</th>
		</tr>
	</thead>
<?php foreach ($objects as $object) 
{ ?>
	<tr>
    	<td><?=substr($object->created,0,10);?></td><td><?=$object->getType()->name; ?></td><td><?=$this->html->link($object->name, 'objects/view/'.$object->id);?></td><td><?=$object->getOwner()->name; ?></td>
    </tr>
<?php } ?>
	<tfoot>
		<tr><td colspan="4">Visa <?php foreach($antal as $a) echo $this->html->link($a, "/objects/index/20/$a").' '; ?></td></tr>
	</tfoot>
</table>
<?php } ?>