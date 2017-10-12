#!/usr/bin/php
<?php
if ($argc < 2)
	return (0);
$tab = array();
$tmp = explode(":", $argv[1], 2);
if (count($tmp) < 2)
	return (0);
$key = $tmp[0];
$tab[$tmp[0]] = $tmp[1];
$i = 2;
while ($i < $argc)
{
	$tmp = explode(":", $argv[$i], 2);
	if (count($tmp) > 1)
	{
		$tab[$tmp[0]] = $tmp[1];
	}
	++$i;
}
echo $tab[$key] . "\n";
?>