<h2>Topp tio</h2>
<table>
	<thead>
		<tr>
			<th>Skador</th><th>Typ</th><th>Nr</th><th>Ägare</th>
		</tr>
	</thead>
<?php foreach ($objectDist as $key => $val) 
{ $object = cams\models\Objects::first($key) ?>
	<tr>
    	<td><?=$objectDist[$object->id];?></td><td><?=$object->getType()->name; ?></td><td><?=$this->html->link($object->name, 'objects::view'.$object->id);?></td><td><?=$object->getOwner()->name; ?></td>
    </tr>
<?php } ?>
</table>

<h2>Skadefördelning</h2>
<table>
	<thead>
		<tr>
			<th>Kod</th><th>%</th><th>Totalt</th>
		</tr>
	</thead>
<?php foreach ($groups as $group) 
{ ?>
	<tr>
    	<td><?=$group[0];?></td><td><?=ceil($group[1]);?></td><td><?=$group[2];?></td>
    </tr>
<?php } ?>
</table>

<table>
	<thead>
		<tr>
			<th>2011</th><?php for($i=1;$i<13;$i++) echo "<th>$i</th>"; ?>
		</tr>
	</thead>
	<tr>
		<td>Rapporterade skador</td>
<?php foreach ($stats[2011] as $m)
{ ?>
        <td><?=$m['reported'];?></td>
<?php } ?>
	</tr>
    <tr>
    	<td>Kvitterade skador</td>
<?php foreach ($stats[2011] as $m)
{ ?>
        <td><?=$m['nulled'];?></td>
<?php } ?>
    </tr>
    <tr>
    	<td>Kvarvarande skador</td>
<?php foreach ($stats[2011] as $m)
{ ?>
        <td><?=$m['remaining'];?></td>
<?php } ?>
    </tr>
</table>

<table>
	<thead>
		<tr>
			<th>2012</th><?php for($i=1;$i<13;$i++) echo "<th>$i</th>"; ?>
		</tr>
	</thead>
	<tr>
		<td>Rapporterade skador</td>
<?php foreach ($stats[2012] as $m)
{ ?>
        <td><?=$m['reported'];?></td>
<?php } ?>
	</tr>
    <tr>
    	<td>Kvitterade skador</td>
<?php foreach ($stats[2012] as $m)
{ ?>
        <td><?=$m['nulled'];?></td>
<?php } ?>
    </tr>
    <tr>
    	<td>Kvarvarande skador</td>
<?php foreach ($stats[2012] as $m)
{ ?>
        <td><?=$m['remaining'];?></td>
<?php } ?>
    </tr>
</table>

<table>
    <thead>
    <tr>
        <th>2013</th><?php for($i=1;$i<13;$i++) echo "<th>$i</th>"; ?>
    </tr>
    </thead>
    <tr>
        <td>Rapporterade skador</td>
        <?php foreach ($stats[2013] as $m)
    { ?>
        <td><?=$m['reported'];?></td>
        <?php } ?>
    </tr>
    <tr>
        <td>Kvitterade skador</td>
        <?php foreach ($stats[2013] as $m)
    { ?>
        <td><?=$m['nulled'];?></td>
        <?php } ?>
    </tr>
    <tr>
        <td>Kvarvarande skador</td>
        <?php foreach ($stats[2013] as $m)
    { ?>
        <td><?=$m['remaining'];?></td>
        <?php } ?>
    </tr>
</table>

<?php
 // Width and height of the graph
$width = 600; $height = 200;
 
// Create a graph instance
$graph = new Graph($width,$height);
 
// Specify what scale we want to use,
// int = integer scale for the X-axis
// int = integer scale for the Y-axis
$graph->SetScale('intint');
 
// Setup a title for the graph
$graph->title->Set('Sunspot example');
 
// Setup titles and X-axis labels
$graph->xaxis->title->Set('(year from 1701)');
 
// Setup Y-axis title
$graph->yaxis->title->Set('(# sunspots)');
 
// Create the linear plot
$lineplot=new LinePlot(array(1,2,3));
 
// Add the plot to the graph
$graph->Add($lineplot);
 
// Display the graph

//$im = $graph->Stroke(__IMG_HANDLER);
//$b64 = base64_encode(stream_get_contents($im));

//echo '<img src="data:image/png;base64,';
//echo $b64;
//echo '" alt="beastie.png" />';

?>
