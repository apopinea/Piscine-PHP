#!/usr/bin/php
<?php
if ($argc < 2)
	return (0);
echo (preg_replace("#[ \t]+#", " ", trim($argv[1], " \t"))) . "\n";
?>