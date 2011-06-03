<h2>Arkiv för <?=$object->ToString();?></h2>

<?php if(count($damages) == 0)
	echo "<h3>Det finns inga arkiverade skador</h3>"; ?>

<?php foreach($damages as $damage) { ?>
	<div style="margin-bottom: 30px;">
	<table style="<?php switch($damage->prio)
	{
		case (1): echo 'border: solid 2px red;'; break;
		case (2): echo 'border: solid 2px yellow;'; break;
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
			<td>Fritext</td><td><span style="font-style: italic;"><?=$damage->notes;?></span></td>
		</tr>
		<tr>
			<td>Skapad</td><td><?=substr($damage->created, 0, 16);?> by <?=$damage->getCreatedBy()->fullname;?></td>
		</tr>
		<?php if(strtotime($damage->modified) > 0) echo "<tr><td>Ändrad</td><td> ".substr($damage->modified, 0 ,16)." av {$damage->getModifiedBy()->fullname}</td></tr>"; ?> 
		<tr>
			<td>Kvitterad</td><td><?=substr($damage->nulled, 0 ,16);?> av <?=$damage->getNulledBy()->fullname;?> </td>	
		</tr>
		<tr>
			<td>Åtgärd</td><td><?=$damage->nulltext;?></td>
		</tr>
				
	</table>
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
