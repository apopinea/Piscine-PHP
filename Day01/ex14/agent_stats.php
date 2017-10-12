#!/usr/bin/php
<?php
	$str = file_get_contents('php://stdin');
	if ($argc < 2)
		return (0);
	$tab = preg_split("#\n#", trim($str, " \t"), -1, PREG_SPLIT_NO_EMPTY);
	sort($tab);
	$max = count($tab);
	$tt = array();
	$i = 0;
	$j = 0;
	while ($i < $max)
	{
		$tmp = explode(";", $tab[$i]);
		if ($tmp[0] && $tmp[1] != null  && (strcmp("Note", $tmp[1]) != 0))
		{
			$tt[$j] = $tmp;
			++$j;
		}
		++$i;
	}
	if (strcmp("moyenne", $argv[1]) == 0)
	{
		$max = count($tt);
		$i = 0;
		$cc = 0;
		$moyen = 0;
		while ($i < $max)
		{
			if (strcmp("moulinette", $tt[$i][2]) != 0)
			{
				$moyen += $tt[$i][1];
				++$cc;
			}
			++$i;
		}
		echo ($moyen / $cc) . "\n";
	}
	else if (strcmp("moyenne_usr", $argv[1]) == 0)
	{
		$tt2 = array();
		$i = 0;
		$max = count($tt);
		while($i < $max)
		{
			if ($tt[$i][1] != null && strcmp("moulinette", $tt[$i][2]) != 0)
			{
				$tt2[$tt[$i][0]][0] += $tt[$i][1];
				$tt2[$tt[$i][0]][1] += 1;
			}
			++$i;
		}
		foreach ($tt2 as $key => $value)
		{
			if ($value[1] != null && $value[1] != 0)
			{
				echo $key. ":".($value[0]/$value[1])."\n";
			}
		}
	}
	else if (strcmp("ecart_moulinette", $argv[1]) == 0)
	{
		$tt2 = array();
		$i = 0;
		$max = count($tt);
		while($i < $max)
		{
			if ($tt[$i][1] != null && strcmp("moulinette", $tt[$i][2]) != 0)
			{
				$tt2[$tt[$i][0]][0] += $tt[$i][1];
				$tt2[$tt[$i][0]][1] += 1;
			}
			else if ($tt[$i][1] != null)
			{
				$tt2[$tt[$i][0]][2] += $tt[$i][1];
				$tt2[$tt[$i][0]][3] += 1;
			}
			++$i;
		}
		foreach ($tt2 as $key => $value)
		{
			if ($value[1] != null && $value[1] !=0 && $value[3] != null && $value[3] !=0)
			{
				echo $key. ":".(($value[0]/$value[1]) - ($value[2]/$value[3]))."\n";
			}
		}
	}
?>