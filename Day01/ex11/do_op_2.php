#!/usr/bin/php
<?php
if ($argc != 2)
{
	echo "Incorrect Parameters\n";
	return (0);
}
$s = preg_replace("#[ \t]+#", '', $argv[1]);
$tab = sscanf($s, "%f%c%f%s");
if (!$tab[0] || !$tab[1] || !$tab[2] || $tab[3])
{
	echo "Syntax Error\n";
	return (0);
}
if ($tab[1][0] == '/')
	$res = $tab[0]/ $tab[2];
else if ($tab[1][0] == '+')
	$res = $tab[0]+ $tab[2];
else if ($tab[1][0] == '-')
	$res = $tab[0]- $tab[2];
else if ($tab[1][0] == '*')
	$res = $tab[0]* $tab[2];
else if ($tab[1][0] == '%')
	$res = $tab[0]% $tab[2];
else
{
	echo "Syntax Error\n";
	return (0);
}
echo $res . "\n";
return (1);
?>