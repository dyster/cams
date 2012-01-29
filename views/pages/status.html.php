<pre>
<?php
use cams\models\Stats;
$sql = mysql_query('SELECT `useragent` FROM `stats` GROUP BY `useragent`;');
for($i=0;$i<mysql_num_rows($sql);$i++)
	$arr[] = mysql_fetch_object($sql)->useragent;

print_r($arr);
foreach($arr as $agent)
{
	//echo $agent;
	//print_r(get_browser($agent));
}

$sql = mysql_query('SELECT `ip`,`user_id` FROM `stats` GROUP BY `ip`;');
for($i=0;$i<mysql_num_rows($sql);$i++)
{
	$o = mysql_fetch_object($sql);
	$ips[] = long2ip($o->ip) . " - " . $o->user_id;
}
	

foreach($ips as $ip)
	echo $ip."\n";
//Stats::all(array('conditions' => array('GROUP BY `useragent`')));
echo shell_exec('uptime');

use cams\models\Mongos;

$mong = Mongos::create();
$mong->test = 'a string';
$mong->save();

?>
</pre>
<?php

print_r(get_browser(null, true));

//echo phpinfo();

use cams\models\Damages;

echo $this->view()->render(
    array('element' => 'table'), 
    array('title' => 'En snygg titel', 'header' => array('created' => 'Skapad', 'short' => 'Titel', 'prio' => 'Prio'), 'rows' => Damages::all())
);

?>
