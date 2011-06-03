<?php
	$browser = get_browser();
	if($browser->browser == 'IE' && $browser->majorver < 8)
	{
   ?>
<div class="noticebox" style="border: solid 2px red">
<p>Du använder en utdaterad webbläsare, denna sida kommer inte att visas rätt och en del funktioner kommer inte att fungera.</p>
<p>Vi rekommenderar att du uppgraderar till <?=$this->html->link('Internet Explorer 9', 'http://windows.microsoft.com/sv-SE/internet-explorer/products/ie/home');?> eller testar en annan webbläsare, såsom</p>
<ul>
	<li><?=$this->html->link('Firefox', 'http://www.getfirefox.com');?></li>
	<li><?=$this->html->link('Google Chrome', 'http://www.google.com/chrome');?></li>
	<li><?=$this->html->link('Opera', 'http://www.opera.com/browser/download/');?></li>
</ul>
</div>
<?php } elseif($browser->browser == 'IE' && $browser->majorver == 8 && ($browser->platform == 'Win7' || $browser->platform == 'WinVista')) {?>

<div class="noticebox" style="border: solid 2px red">
	Du bör uppdatera till <?=$this->html->link('Internet Explorer 9', 'http://windows.microsoft.com/sv-SE/internet-explorer/products/ie/home');?>
</div>
<?php } ?>

<h2>Nyheter</h2>

	<?php foreach($news as $new) { ?>
<table>
	<tr>
		<td><strong><?=$new->post;?></strong></td>
	</tr>
	<tfoot>
		<tr>
			<td><?=$new->getCreatedBy()->fullname;?> - <?=substr($new->created, 0, 16);?></td>
		</tr>
	</tfoot>
</table>
	<?php } ?>


<h2>Dina Tickets</h2>
<table>
	<thead>
		<tr>
			<th>#</th><th>Titel</th><th>Typ</th><th>Skapad</th><th>Kommentarer</th>
		</tr>
	</thead>
	<?php foreach($usertickets as $ticket) { ?>
	<tr>
		<td><?=$ticket->id;?></td>
		<td><?=$this->html->link($ticket->title, 'tickets/view/'.$ticket->id);?></td>
		<td><?=$ticket->type;?></td>
		<td><?=substr($ticket->created, 0, 16);?></td>
		<?php $c = $ticket->getCommentsCount();?>
		<?php 
		if($c > 0)
		{
			$linktext = $c . ' [Läs] ';
			if($ticket->updated) $linktext .= ' ! Uppdaterad !';
			echo '<td>'.$this->html->link($linktext, 'tickets/view/'.$ticket->id);
			echo '</td>';
		}  
		?>
	</tr>
	<?php } ?>
</table>
