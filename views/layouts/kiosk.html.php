<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>CAMS<?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('styles', 'base', 'lithium')); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
	
	<style>
	#content {	
			padding: 20px;
	}
	table {
		width: 100%;
	}
	</style>

<script type="text/JavaScript">
<!--
function timedRefresh(timeoutPeriod) {
	setTimeout("location.reload(true);",timeoutPeriod);
}
//   -->
</script>

</head>



<body class="app" onload="JavaScript:timedRefresh(30000);">
	<div id="userbox">
		
			<br />
			<img src="http://coresys.se/images/system.png" alt="logo" style="float: right;" />
	</div>
	
		<div id="header">
			<?=$this->html->image('ownerlogos/1.jpg', array('width' => '717', 'height' => '74'));?>
		</div>
		
		
		<div id="content">
			
				
			
			<?php echo $this->content(); ?>
			
			<div id="spacer"></div>
			
		</div>
		
		
	
	
	
	
</body>
</html>
