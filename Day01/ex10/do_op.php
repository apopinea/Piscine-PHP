#!/usr/bin/php
<?php
if ($argc != 4)
{
	echo "Incorrect Parameters\n";
	return (0);
}
$a = trim($argv[1], " \t");
$op = trim($argv[2], " \t");
$b = trim($argv[3], " \t");
if ($op[0] == '/')
	$res = $a / $b;
else if ($op[0] == '+')
	$res = $a + $b;
else if ($op[0] == '-')
	$res = $a - $b;
else if ($op[0] == '*')
	$res = $a * $b;
else if ($op[0] == '%')
	$res = $a % $b;
else
{
	echo "Incorrect Parameters\n";
	return (0);
}
echo $res . "\n";
return (1);
?>