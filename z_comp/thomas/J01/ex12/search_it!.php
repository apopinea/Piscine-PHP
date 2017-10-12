#!/usr/bin/php
<?php

if ($argc > 1)
{
	$elem = explode(":", $argv[1], 2);
	if (count($elem) > 1)
		$key[$elem[0]] = $elem[1];
	$tmp = $elem[0];
	$i = 2;
	while ($i < $argc)
	{
		$elem = explode(":", $argv[$i], 2);
		if (count($elem) > 1)
			$key[$elem[0]] = $elem[1];
		++$i;
	}
	if ($key[$tmp])
		echo $key[$tmp]."\n";
}
?>
