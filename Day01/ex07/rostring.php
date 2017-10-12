#!/usr/bin/php
<?php
if ($argc >= 2)
{
	$tab = preg_split("# +#",$argv[1], -1, PREG_SPLIT_NO_EMPTY);
	$i = count($tab);
	if ($i > 0)
	{
		$tab[$i] = $tab[0];
		array_shift($tab);
		echo implode(" ", $tab) . PHP_EOL;
	}
}
?>