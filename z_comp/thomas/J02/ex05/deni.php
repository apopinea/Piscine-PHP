#!/usr/bin/php
<?php
if ($argc != 3)
	exit();
if (!file_exists($argv[1]))
	exit();

$fd = fopen($argv[1], 'r');
$lock = true;
$i = 0;

while ($fd && !feof($fd))
	{
		$arr[] = explode(";", fgets($fd));
		if ($lock)
		{
				$lock = false;
				$head = $arr[$i];

				if(!($index = array_search($argv[2], $head)))
					exit();
				$i++;
				continue;
		}
		$nom[trim($arr[$i][$index])] = $arr[$i][0];
		$prenom[trim($arr[$i][$index])] = $arr[$i][1];
		$mail[trim($arr[$i][$index])] = $arr[$i][2];
		$IP[trim($arr[$i][$index])] = $arr[$i][3];
		$pseudo[trim($arr[$i][$index])] = $arr[$i][4];
		$i++;
	}

$fd_stdin = fopen("php://stdin", 'r');
while ($fd_stdin)
	{
		echo "Entrez votre commande: ";
		$cmd = fgets($fd_stdin);
		$arr = explode(' ', trim($cmd));
			if ($cmd && $arr[0] != "rm")
				eval($cmd);
			else
			{
				echo "\n";
				fclose($fd_stdin);
				exit(0);
			}
	}
	fclose($fd_stdin);
?>