<table>
	<tr>
		<td>ID</td><td>Controller</td><td>Action</td>
	</tr>
	<?php foreach($acos as $aco) {?>	
	<tr>
		<td><?=$aco->id;?></td><td><?=$aco->controller;?></td><td><?=$aco->action;?></td>  
	</tr>
	<?php } ?>
</table>