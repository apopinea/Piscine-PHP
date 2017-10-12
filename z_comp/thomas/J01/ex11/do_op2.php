#!/usr/bin/php

<?php

function sum($data)
{
  $data['res'] = $data["a"] + $data["b"];
  return ($data);
}

function sust($data)
{
  $data["res"] = $data["a"] - $data["b"];
  return ($data);
}

function mult($data)
{
  $data["res"] = $data["a"] * $data["b"];
  return ($data);
}

function div($data)
{
  if ($data['b'] == 0)
    $data['res'] = 'inf';
  else
    $data["res"] = $data["a"] / $data["b"];
  return ($data);
}

function mod($data)
{
  if ($data['b'] == 0)
    $data['res'] = 'nan';
  else
    $data["res"] = $data["a"] % $data["b"];
  return ($data);

}

function parse($str)
{
  $data = array(
      'a' => 0,
      'op' => '',
      'idop' => 0,
      'b' => 0,
      'res' => 0);
  $cpt = 0;
  $ops = ['+','-','*','/','%'];
  foreach ($ops as $op) {
    $pos = strpos($str, $op);
    if ($pos != null)
    {
      $data['op'] = $str[$pos];
      $data['idop'] = $pos;
      $cpt++;
    }
  }
  $a = 0;
  $i = 0;
  while(!is_numeric($str[$i]))
    $i++;
  for (; is_numeric($str[$i]); $i++) {
    $a = 10 * $a + intval($str[$i]);
  }
  $data['a'] = $a;
  $a = 0;
  while(!is_numeric($str[$i]))
    $i++;
  for (; is_numeric($str[$i]) ; $i++) {
    $a = 10 * $a + intval($str[$i]);
  }
  $data['b'] = $a;
  if ($cpt != 1)
    exit("Syntax Error" . PHP_EOL);
  return($data);
}

function do_op($args)
{
  $op_tab = [
    '+' => 'sum',
    '-' => 'sust',
    '*' => 'mult',
    '/' => 'div',
    '%' => 'mod'
  ];
  echo $op_tab[$args['op']]($args)['res'] . PHP_EOL;
}

if ($argc == 2)
{
  $d = parse($argv[1]);
  do_op($d);
}
else
  exit('Incorrect Parameters' . PHP_EOL);

 ?>
