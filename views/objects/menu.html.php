<ul>
	<?php
	$i = 0;
	foreach($controllerMenu['objects'] as $key => $val) {
		echo "\n<li><a href=\"javascript:display('submenu$i')\">".$key."</a>\n\t<ul class=\"".$val['class']."\" id=\"submenu$i\">";
		foreach($val['items'] as $item)
			echo "\n\t\t".'<li><a href="'.$item['link'].'">'.$item['name']."</a></li>";
		echo "</ul></li>";
		$i++;
	} ?>
</ul>