#!/usr/bin/php
<?php
function ft_is_sort($tab)
{
	$tab2 = $tab;
	sort($tab2);
	$max = count($tab);
	$i = 0;
	while ($i < $max)
	{
		if ($tab[$i] != $tab2[$i])
			return (false);
		++$i;
	}
	return (true);
}
?>