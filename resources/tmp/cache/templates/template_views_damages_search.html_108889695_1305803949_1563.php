<?php if(isset($damages) && count($damages) > 0) { ?>
<h3>Skador</h3>
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
		case (2): echo 'background: #fbf678;'; break;
		default: echo ''; break;
	} ?>"><?php echo $h($damage->prio); ?></td>
		<td><?php echo $h($damage->getCreatedBy()->fullname); ?></td>
	</tr>	
	<?php } ?>
</table>
<?php } ?>

<?php if(isset($objects) && count($objects) > 0) { ?>
<h3>Fordon</h3>
<table>
	<thead>
		<tr>
			<th>Typ</th><th>Nr</th><th>Ägare</th>
		</tr>
	</thead>
<?php foreach ($objects as $object) 
{ ?>
	<tr>
    	<td><?php echo $h($object->getType()->name); ?></td><td><?php echo $this->html->link($object->name, 'objects/view/'.$object->id); ?></td><td><?php echo $h($object->getOwner()->name); ?></td>
    </tr>
<?php } ?>
</table>
<?php } ?>

<?php if(isset($news) && count($news) > 0) { ?>
<h3>Nyheter</h3>
	
<?php foreach ($news as $new) 
{ ?>
	<table>
	<tr>
		<td><strong><?php echo $h($new->post); ?></strong></td>
	</tr>
	<tfoot>
		<tr>
			<td><?php echo $h($new->getCreatedBy()->fullname); ?> - <?php echo $h(substr($new->created, 0, 16)); ?></td>
		</tr>
	</tfoot>
</table>
<?php } ?>

<?php } ?>