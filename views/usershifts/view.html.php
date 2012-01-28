<?php $data = $usershift->to('array'); ?>


<table>
	<tbody>
		<?php foreach($data as $key => $val) { ?>
		<tr>
			<td><?=$key;?></td><td><?=$val;?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>
