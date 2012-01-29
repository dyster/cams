<pre><?php
	$browser = get_browser();
	print_r($browser);
	if($browser->browser == 'IE' && $browser->majorver < 8)
	{
   ?>
</pre>
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