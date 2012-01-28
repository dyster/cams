<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2011, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>CAMS<?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('styles', 'base', 'lithium')); ?>
	<?php echo $this->html->style('print', array('media' => 'print')); ?>
	<?php echo $this->html->style('handheld', array('media' => 'handheld')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>

<script type="text/Javascript">
<!--
function display (category) {
	var whichcategory = document.getElementById(category);
	if (whichcategory.className=="show") {
		whichcategory.className="hide";
	} else {
		whichcategory.className="show";
	}
}
-->
</script>

</head>
<body class="app">
	<div id="userbox">
		<?php
			
			use lithium\security\Auth;
			
			$authz = Auth::check('user');
			if(!$authz)
				echo $this->html->link("Logga In", '/login');
			else
				echo $this->html->link($_SESSION['user']['fullname'], '/users/profile')  . " | " . $this->html->link("Logga Ut", '/logout');
			
			?>
			<br />
			<img src="http://coresys.se/images/system.png" alt="logo" style="float: right;" />
	</div>
	
		<div id="header">
			<?=$this->html->image('ownerlogos/1.jpg', array('width' => '717', 'height' => '74'));?>
		</div>
		<!--<div id="topmenu">
			<ul>
				<li><?=$this->html->link('Fordon','objects/index', array('class' => 'knapp'));?></li>
				<li><?=$this->html->link('Skadeflöde','damages/index', array('class' => 'knapp'));?></li>
			</ul>
		</div> -->
		<div id="left-bar">
			<?php
			use cams\models\acls;
			 if($authz)
			 { ?>
			
			<div class="shadow">
				<label>Skadehantering</label>
				<ul>
					<li><?=$this->html->link('Hem', 'news/index');?></li>
					<li><?=$this->html->link('Bläddra', 'damages/browse');?></li>
					<li><?=$this->html->link('Fordon', 'objects/index');?></li>
					<li><?=$this->html->link('Skadeflöde', 'damages/index');?></li>
					<li><?=$this->html->link('Ägare', 'owners/index');?></li>
					<li><?=$this->html->link('Statistik', 'damages/statistics');?></li>			
				</ul>
			</div>
						
			<div class="shadow">
				<label>Projekt</label>
				<ul>
					<li><?=$this->html->link('Index', 'projects/index');?></li>
					<li><?=$this->html->link('Kioskläge', 'projects/kiosk');?></li>
						
				</ul>
			</div>
			
			<div class="shadow">
				<form id="searchbox" action="/damages/search" method="post"><input type="text" name="q" id="q" /><input type="submit" value=">" /></form>		
			</div>
			<?php } ?>
			
			
			<?php
			
			if(isset($controllerMenu))
			{ ?>
			<div class="shadow">
				<label><?=$controllerMenu['title'];?></label>
				<ul>
					<?php
					$i = 0;
					foreach($controllerMenu['objects'] as $key => $val)
					{
						echo "\n<li><a href=\"javascript:display('submenu$i')\">".$key."</a>\n\t<ul class=\"".$val['class']."\" id=\"submenu$i\">";
						foreach($val['items'] as $item)
							echo "\n\t\t".'<li><a href="'.$item['link'].'">'.$item['name']."</a></li>";
						echo "</ul></li>";
						$i++;
					}
					?>
					
				</ul>
			</div>	
			<?php } ?>
			
			
			
			<?php
			
			if($authz)
			{
				if(acls::getAllowedAction($authz['id'], 'users', 'index'))
					$adminmenu['Användare'][] = array('show' => 'Index', 'link' => 'users/index');
				if(acls::getAllowedAction($authz['id'], 'users', 'add'))
					$adminmenu['Användare'][] = array('show' => 'Lägg till', 'link' => 'users/add');
				if(acls::getAllowedAction($authz['id'], 'tickets', 'index'))
					$adminmenu['Tickets'][] = array('show' => 'Index', 'link' => 'tickets/index');
				if(acls::getAllowedAction($authz['id'], 'objects', 'add'))
					$adminmenu['Fordon'][] = array('show' => 'Lägg till', 'link' => 'objects/add');
				if(acls::getAllowedAction($authz['id'], 'news', 'add'))
					$adminmenu['Nyheter'][] = array('show' => 'Lägg till', 'link' => 'news/add');
				if(acls::getAllowedAction($authz['id'], 'projects', 'add'))
					$adminmenu['Projekt'][] = array('show' => 'Lägg till', 'link' => 'projects/add');
				
			} ?>
			
			<?php 
			if(isset($adminmenu))
			{
				echo '<div class="shadow"><label>Admin</label><ul>';
				foreach($adminmenu as $key => $val)
				{
					echo '<li><span style="color: #00a8e6 ;">'.$key.'</span>';
						echo '<ul class="show">';
						foreach($val as $v)
							echo '<li>' . $this->html->link($v['show'], $v['link']) . '</li>';
						echo '</ul>';
					echo '</li>';
				}
				echo '</ul></div>';
			}
								
			 ?>
									
			
			
			
			
		</div>
		<div id="content">
			
			<?php
						
			$flash = $this->flashMessage->output();
			if(!empty($flash))
				echo $flash;
				
			if(isset($_SESSION['notifications']))
			{ foreach($_SESSION['notifications'] as $note) { ?>
				<div class="noticebox <?=$note['class'];?>"><?=$note['text'];?></div>
			<?php 
				}
				$_SESSION['notifications'] = null;
				}?>
			
			
			<?php echo $this->content(); ?>
			<?php
				
				if(isset($_SESSION['queries']))
				{
					$qprint = "<ul>\n";
					$sum = 0;
					$tick = 0;
					foreach($_SESSION['queries'] as $row)
					{
						$qprint .= "<li><strong>" . $row['sum'] . "</strong> " . $row['query'] . "</li>";
						$sum += $row['sum'];
						$tick++;
					}
					$qprint .= "<li></li><li>Summary: $tick queries in $sum seconds</li>\n</ul>";
															
					$_SESSION['queries'] = null;
						
					if(isset($_SESSION['user']) && $_SESSION['user']['id'] == 19)
					{
						echo $qprint;					
					}
				}
			?>
			<div id="spacer"></div>
			<div id="footer">
				<hr />
			<ul>
				<!--<li>Powered by <?=$this->html->link('Apache', 'http://httpd.apache.org/');?></li>
				<li><?=$this->html->link('CentOS', 'http://www.centos.org/');?></li>
				<li><?=$this->html->link('Lithium', 'http://lithify.me/'); ?></li> -->
				<li><?=$this->html->link('Synpunkter/Buggar på denna sida', '/tickets/add/'.substr(str_replace('/', '::', $_SERVER['QUERY_STRING']), 4));?></li>
				<!--
				<li><a id="thislink" onclick="
document.getElementById('left-bar').style.display = 'none';
document.getElementById('footer').style.display = 'none';
document.getElementById('thislink').style.display = 'none'; 
document.getElementById('content').style.padding = '20px';
">Kioskläge</a></li>
				-->
				<?php if(isset($_SESSION['queries'])) { ?><li><?=$tick;?> databasförfrågningar på <?=$sum?> sekunder</li><?php } ?>
			</ul>
	</div>
		</div>
		
		
	
	
	
	
</body>
</html>
