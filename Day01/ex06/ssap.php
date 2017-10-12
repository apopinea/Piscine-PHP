#!/usr/bin/php
<?php
$i = true;
$e = array();
foreach ($argv as $val)
{
	if($i)
		$i = false;
	else
	{
		$tab = preg_split("# +#",$val, -1, PREG_SPLIT_NO_EMPTY);
		$e = array_merge($tab, $e);
	}
}
asort($e);
foreach ($e as $val)
{
	echo $val . PHP_EOL;
}
?>