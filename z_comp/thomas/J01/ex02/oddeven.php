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

  $nbr = explode(" ", $line);

  if (count($nbr) == 1 && intval($nbr[0]))
  {
    if (!($nbr[0] % 2))
    {
    echo "Le chiffre " . substr($nbr[0], 0, -1) . " est Pair" . PHP_EOL;
    }
    else {
      echo "Le chiffre " . substr($line, 0, -1) . " est Impair" . PHP_EOL;
    }
  }
  else if (count($nbr) > 1)
  {
    echo "Un seul nombre a la fois...\n";
  }
  else {
      echo "'" . substr($line, 0, -1) . "' n'est pas un chiffre" . PHP_EOL;
  }
  return (1);
}

  while(odd_or_even());

?>
