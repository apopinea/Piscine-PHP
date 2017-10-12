#!/usr/bin/php
<?php
function odd_or_even()
{
	echo "Entrez un nombre: ";
	$line = fgets(STDIN);
	if (!$line)
	{
		echo "\n";
		return (0);
	}
	$line = substr($line, 0, -1);
	$nbr = explode(" ", $line);

	foreach ($nbr as $val)
	{
		//var_dump($val);
		if (is_numeric($val))
		{
			if ($val % 2 == 0)
				echo "Le chiffre " . $val . " est Pair\n";
			else
				echo "Le chiffre " . $val . " est Impair\n";
		}
		else
		{
			echo "'" . $val . "'" . " n'est pas un chiffre\n";
		}
	}
	return (1);
}
while(odd_or_even())
?>