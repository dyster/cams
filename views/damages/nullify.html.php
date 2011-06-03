<table>
	<tr>
		<td>Skadetext</td><td><?=$damage->short;?></td>
	</tr>
	<tr>
		<td>Prio</td><td><?=$damage->prio;?></td>
	</tr>
	<tr>
		<td>Fritext</td><td><?=$damage->notes;?></td>
	</tr>
	<tr>
		<td>Skapad</td><td><?=substr($damage->created, 0 , 16);?></td>
	</tr>
	<tr>
		<td>Skapad av</td><td><?=$damage->getCreatedBy()->fullname;?></td>
	</tr>
</table>
<?=$this->form->create($damage); ?>
<label>Åtgärd</label>
<?=$this->form->textarea('nulltext'); ?>
<?=$this->form->submit('Kvittera'); ?>
<?=$this->form->end(); ?>