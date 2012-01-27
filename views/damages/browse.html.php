

<form style="height: 40px;" action="/damages/browse/" method="post">
	<div style="float: left;">
			<label>Visa aktiva
			<?=$this->form->checkbox('active', array('checked' => $active));?>
			</label> <br />
			<label>Visa kvitterade
			<?=$this->form->checkbox('inactive', array('checked' => $inactive));?></label>
	</div>
	<div style="float: right;">	
			<input type="submit" value="Uppdatera" />
	</div>
</form>



<div>
        <?php if($page > 1):?>
                <?=$this->html->link('< Föregående', array('Damages::browse', 'page'=> $page - 1));?>
        <?php endif;?>        <?php if($total > ($limit * $page)):?>
                <?=$this->html->link('Nästa >', array('Damages::browse', 'page'=> $page + 1));?>
        <?php endif;?>
        
</div>
<div>
	<?php for($i=1;$i<$total/$limit+1;$i++) {?>
      		<?php if($i == $page):?><strong><?php endif;?>
        	<?=$this->html->link($i, array('Damages::browse', 'page'=> $i));?>
        	<?php if($i == $page):?></strong><?php endif;?>
        <?php } ?>
</div>

<table>
	<thead>
		<tr>
			<th style="width: 20px;">ID</th><th style="width: 110px;">Inlagd</th><th style="width: 20px;">Prio</th><th style="width: 150px;">Fordon</th><th style="width: 20px;">Grupp</th><th>Skada</th><th style="width: 120px;">Inlagd av</th>
		</tr>
	</thead>
	<?php foreach($posts as $damage) { $object = $damage->getObject(); ?>
	<tr>
		<td><?=$damage->id;?></td>
		<td><?=substr($damage->created, 0, 16);?></td>
		<td style="<?php switch($damage->prio)
	{
		case (1): echo 'background: #fd8888;'; break;
		case (2): echo 'background: #3bb9ff;'; break; // gul = #fbf678
		default: echo ''; break;
	} ?>"><?=$damage->prio;?></td>
		<td> <?=$this->html->link($object->toString(), 'objects/view/'.$object->id);?></td>
		<td><?=$object->group;?></td>
		<td><?=$this->html->link($damage->short, 'damages/view/'.$damage->id);?></td>
		<td><?=$damage->getCreatedBy()->fullname;?></td>
	</tr>	
	<?php } ?>
</table>
