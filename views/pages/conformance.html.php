
<div class="noticebox" style="border: solid 1px black">
<p>Här på Coresys ligger vi i framkant på tekniken för att leverera den bästa tänkbara användarupplevelsen. Det gör tyvärr inte din webbläsare.</p>
<p>Vi rekommenderar att du byter till <?=$this->html->link('Google Chrome', 'http://www.google.com/chrome');?> eftersom den är liten, smidig och stödjer nästan alla web-tekniker.</p>
<p>Alternativet för dig med Internet Explorer är att installera <?=$this->html->link('ChromeFrame', 'http://www.google.com/chromeframe');?>, det tar bara några sekunder.</p>

</div>

<script language="JavaScript" type="text/javascript">
window.onload = function() {
	<?php
		$arr = array(	'Scalable Vector Graphics' => 'svg',
						'Inline SVG' => 'inlinesvg',
						'Synchronied Multimedia Integration Language' => 'smil',
						'HashChange' => 'hashchange',
						'Cross-window messaging' => 'postmessage',
						'Session Storage' => 'sessionstorage',
						'CSS: border radius' => 'borderradius',
						'CSS: box shadow' => 'boxshadow',
						'CSS: opacity' => 'opacity',
						'CSS: rgba' => 'rgba',
						'CSS: animations' => 'cssanimations',
						'CSS: columns' => 'csscolumns');
		foreach($arr as $test)
			echo "if(Modernizr.$test) { document.getElementById('$test').style.border = 'solid 2px #467F0D'; };";
	?>
}

</script>

<?php
	foreach($arr as $desc => $id) { ?>
	<div id="<?=$id;?>" class="noticebox" style="border: solid 2px red; border-radius: 5px;">
		<?=$desc;?>
	</div>
<?php } ?>
