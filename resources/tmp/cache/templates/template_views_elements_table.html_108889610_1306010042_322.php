<?php if($title) { ?> 
	<h2><?php echo $h($title); ?></h2>
<?php } ?>

<table>
<thead>
	<tr>
		<?php foreach($header as $head) echo '<th>'.$head.'</th>'; ?>
	</tr>
</thead>
<?php foreach($rows as $row) { ?>
<tr>
	<?php foreach($header as $key => $item) echo '<td>'.$row->{$key}.'</td>'; ?> 
</tr>
<?php } ?>
</table>

