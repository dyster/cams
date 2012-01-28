<?php
$width=1000;
$height=650;
$top_margin = 30;
$bottom_margin = 20;
$left_margin = 130;
$right_margin = 20;
$row_height = ($height-$top_margin-$bottom_margin)/count($objects);

$fromdate = new DateTime("now");
$todate = new DateTime("+6 days");
$days = $fromdate->diff($todate)->days + 1;
$col_width = ($width-$right_margin-$left_margin)/$days;

?>
<svg xmlns="http://www.w3.org/2000/svg" width="<?=$width;?>" height="<?=$height;?>">
  
	<!-- draw border -->
  	<rect x="2" y="2" rx="20" width="<?=$width-4;?>" height="<?=$height-4;?>" style="fill: none;stroke:black;stroke-width:2;" />
	
	<!-- print generation time at bottom -->
	<text x="20" y="<?=$height-5;?>" fill="red">Skapad <?=date('Y-m-d H:i:s', time());?></text>

	<!-- draw top border line -->
	<line x1="3" y1="<?=$top_margin;?>" x2="<?=$width-3;?>" y2="<?=$top_margin;?>" style="stroke:black;stroke-width:2"/>

	<!-- iterate objects -->
	<?php for($i=1; $i <= count($objects); $i++) { $lower = $i*$row_height+$top_margin; $upper = ($i-1)*$row_height+$top_margin+1 ?>
		<line x1="3" y1="<?=$lower;?>" x2="<?=$width-3;?>" y2="<?=$lower;?>" style="stroke:lightgrey;stroke-width:2"/>
		<text x="5" y="<?=$lower-2;?>" fill="black"><?=$objects[$i]->name;?></text>
		<text x="5" y="<?=$lower-22;?>" fill="black"><?=$objects[$i]->GetType()->name;?></text>
	<?php } ?>

	<!-- generate timespan -->
	<?php for($x=1; $x <= $days; $x++)  { $left = $left_margin+$col_width*($x-1); $right = $left_margin+$col_width*$x-1;?>
		<line x1="<?=$left;?>" y1="3" x2="<?=$left;?>" y2="<?=$height-$bottom_margin;?>" style="stroke:lightgrey;stroke-width:2"/>
		<text x="<?=$left+2;?>" y="20" fill="black"><?=$fromdate->format('d/m');?></text>
		<?php $fromdate->add(new DateInterval('P1D')) ?>
	<?php } ?>
</svg>