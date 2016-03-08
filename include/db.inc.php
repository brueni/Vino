<?php

$db = mysql_connect($servers['host'], $servers['user'], $servers['password']);
if (!$db)
{
	echo "Keine Verbindung zu Datenbank-Server $servers[host] möglich! Bitte kontaktieren Sie den Administrator";
	exit;
}
else
{
	if(mysql_select_db($servers['db'], $db))
	{
	}
	else
	{
		echo "Datenbank \"$servers[db]\" wurde nicht gefunden. Bitte kontaktieren Sie den Administrator<br>";
		exit;
	}
}

?>
