#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
if ($argc < 2)
	return (0);
$tab = sscanf($argv[1], "%s %d %s %d %s%s");
if ($tab[0] !== null && $tab[1] !== null && $tab[2] !== null && $tab[3] !== null && $tab[4] !== null && $tab[5] == null)
{
	$day = ["lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimache"];
	$nb_day = array_search(lcfirst($tab[0]), $day);
	$month = ['janvier', 'fevrier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre', 'décembre'];
	$tmp = array_search(lcfirst($tab[2]), $month);
	if ($nb_day !== false && $tmp !== false)
	{
		$mounths = array(
		    'janvier' => '1',
		    'fevrier' => '2',
		    'février' => '2',
		    'mars' => '3',
		    'avril' => '4',
		    'mai' => '5',
		    'juin' => '6',
		    'juillet' => '7',
		    'aout' => '8',
		    'septembre' => '9',
		    'octobre' => '10',
		    'novembre' => '11',
		    'decembre' => '12',
		    'décembre' => '12');
		$a = preg_match("#([0-9]){4}#", $tab[3]);
		$b = preg_match("#[0-2][0-9]:[0-6][0-9]:[0-6][0-9]#", $tab[4]);
		if (strlen($tab[3]) == 4 && $a == 1 && strlen($tab[4]) == 8 && $b == 1)
		{
			$tab[0] = $nb_day;
			$tab[2] = $mounths[$month[$tmp]];
			$str = implode(" ", $tab);
			$tt = (strptime($str, "%w %d %m %Y %H:%M:%S"));
			if ($tt !== false)
			{
				$tmp = mktime($tt["tm_hour"], $tt["tm_min"], $tt["tm_sec"], $tt["tm_mon"] + 1, $tt["tm_mday"], $tt["tm_year"] + 1900);

				
				if (checkdate($tt["tm_mon"] + 1, $tt["tm_mday"], $tt["tm_year"] + 1900) === true)
				{
					echo $tmp ."\n";
					return (1);
				}
			}
		}
	}
}
	echo "Wrong Format\n";
?>