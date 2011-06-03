<table>
<pre>
<?php 
$i = 0; 
foreach($wheeldims as $wheeldim) 
{
	var_dump($wheeldim);  
	if($i == 0)
	{
		echo "<thead>";
		foreach($wheeldim as $key => $val)
			echo "<th>$key</th>";
		echo "</thead>";
	}
	
	echo "<tr>";
	foreach($wheeldim as $val)
		echo "<td>$val</td>";
	echo "</tr>";
	
	$i++;
} 
?></pre>
</table>