#!/usr/bin/php
<?php
function ft_split($s1)
{
	return (preg_split("# +#",$s1, -1, PREG_SPLIT_NO_EMPTY));
}
/*
if ($argc >= 2)
{
	$ss = ft_split($argv[1]);
	foreach ($ss as $val)
	{
		$s2 = $s2 . " " . $val;
	}
	echo $s2 . "\n";
}
*/
function ft_merge($arr)
{
  $line = implode(" ", $arr);
  if ($line)
 	return ($line . PHP_EOL);
 return (null);
}
print(ft_merge(ft_split($argv[1])));
?>