#!/usr/bin/php
<?php
function ft_replace2($matches)
{
	$str = preg_replace_callback("#([^<]*)(<[^>]*>)(.*)#s", "ft_replace2", $matches[3]);
	$res = strtoupper($matches[1]) . $matches[2] . $str;
	return ($res);
}
function ft_replace1($matches)
{
	$str = preg_replace_callback("#([^<]*)(<[^>]*>)(.*)#s", "ft_replace2", $matches[3]);
	$tab = $matches[1] . strtoupper($matches[2]) . $str . $matches[4];
	return ($tab);
}
function ft_replace3($matches)
{
	return($matches[1] . strtoupper($matches[2]) . $matches[3]);
}
if ($argc != 2)
	return (0);
$str = file_get_contents($argv[1]);
if ($str === false)
	return (0);
$str = preg_replace_callback("#(<a[^>]*>)([^<]*)(.*)(</a>)#s", "ft_replace1", $str);
$str = preg_replace_callback('#(title=")(.*)(")#', "ft_replace3", $str);
echo $str."\n";
?>