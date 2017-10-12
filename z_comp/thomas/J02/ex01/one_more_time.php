#!/usr/bin/php
<?php
function ft_split($str)
{
  return (preg_split("/\\s+/",$str, -1, PREG_SPLIT_NO_EMPTY));
}

function check_time($str)
{
  $h12 = preg_match("/(1[012]|0[0-9]):([0-5][0-9]):([0-5][0-9])/", $str);
  $h24 = preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9]:([0-5][0-9]))/", $str);
  $h2459 = preg_match("/(2[0-4]|[01][1-9]|10):([0-5][0-9]:([0-5][0-9]))/", $str);
  if ($h12 or $h24 or $h2459)
    return true;
  else
    return false;
}

function parse($str)
{
  $week = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimache'];
  $mounth = ['janvier', 'fevrier','février','mars','avril','mai','juin','juillet','aout','septembre','octobre','novembre','decembre', 'décembre'];
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

  $data = ft_split(strtolower($str));

  if (count($data) != 5 or !checkdate(intval($mounths[$data[2]]), intval($data[1]), intval($data[3]))
                        or !check_time($data[4])
                        or !in_array($data[0],$week)
                        or !in_array($data[2],$mounth)
                        or $data[4][2] != ':'
                        or $data[4][5] != ':')
                        {
                          echo "Wrong Format" . PHP_EOL;
						  exit();
                        }
  $tstr_h = explode(':', $data[4]);
  $timestamp = mktime(intval($tstr_h[0]),
                      intval($tstr_h[1]),
                      intval($tstr_h[2]),
                      intval($mounths[$data[2]]),
                      intval($data[1]),
                      intval($data[3]));

  print($timestamp . PHP_EOL);
//  echo date('m/d/Y h:i:s', 1384254141);


}

if ($argc == 2)
{
  date_default_timezone_set('Europe/Paris');
  parse($argv[1]);
}
?>
