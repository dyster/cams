

<table>
	<thead>
		<th width="50">OrderNr</th>
		<th width="30">Litt.</th>
		<th width="50">Fordon</th>
		<th>Ort</th>
		<th>Beskrivning</th>
		
	</thead>
<?php foreach($projects as $p){ ?>
	<tr>
		<td style="padding: 0px 5px 0px 5px; background-color: <?=$p->colour;?>;" class="strong"><?=$this->html->link($p->project_nr, '/projects/view/'.$p->id);?></td>
		<td style="padding: 0px 5px 0px 5px" class="strong"><?=$p->typ;?></td>
		<td style="padding: 0px 5px 0px 5px" class="strong"><?=$p->fordon;?></td>
		<td><?=$p->ort;?></td>
		<td style="padding: 0px 5px 0px 5px" class="strong"><?=$this->html->link($p->description, '/projects/view/'.$p->id);?></td>
	</tr>
<?php } ?>
</table>


