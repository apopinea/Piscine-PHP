#!/usr/bin/php
<?php
function ft_is_what($s) // class s en fonction de lettre chiffre ou autre
{
	if (($s >= 'A' && $s <= 'Z') || ($s >= 'a' && $s <= 'z'))
		return (0);
	if (($s >= '0' && $s <= '9'))
		return (1);
	return (2);
}

function ft_ssort($s1, $s2)
{
	$is1 = ft_is_what($s1[0]);
	$is2 = ft_is_what($s2[0]);
	if ($is1 < $is2)
		return (false);
	if ($is1 > $is2)
		return (true);
	if (strcasecmp($s1, $s2) > 0)
		return (true);
}

function ft_sort_chelou(&$tab)
{
	$i = 0;
	$max = count($tab);
	while ($i < $max)
	{
		$j = $i + 1;
		while ($j < $max)
		{
			if (ft_ssort($tab[$i], $tab[$j])) //on regarde si on switch
			{
				$tmp = $tab[$i];
				$tab[$i] = $tab[$j];
				$tab[$j] = $tmp;
			}
			++$j;
		}
		++$i;
	}
}

if ($argc < 2)
	return (0);
$tab = array();
for ($i = 1; $i < $argc; $i++)
{
	$tab = array_merge($tab, preg_split("# +#", $argv[$i], -1, PREG_SPLIT_NO_EMPTY));
}
if ($tab)
{
	ft_sort_chelou($tab);
	echo implode("\n", $tab) . "\n";
}
?>