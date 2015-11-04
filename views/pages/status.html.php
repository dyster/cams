<?php
	$checks = array(
		23073 => 'Soldat',
		25 => 'SMTP',
		26 => 'Alt SMTP',
		10011 => 'Teamspeak',
		30033 => 'Teamspeak',
		3306 => 'MySQL',
		443 => 'HTTPS',
		993 => 'Secure IMAP',
		143 => 'IMAP',
		22 => 'SSH',
		27017 => 'MongoDB'
	);

	foreach($checks as $port => $service)
	{
		$fs = @fsockopen('localhost', $port, $errno, $errstr, 2);
		if(!$fs)
			echo "<li>$service: $errno -> $errstr</li>\n";
		else {
			echo "<li>$service: OK</li>\n";
			fclose($fs);
		}

	}

	echo phpinfo();

?>
