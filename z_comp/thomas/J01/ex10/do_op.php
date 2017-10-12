#!/usr/bin/php
<?php

function parse($args)
{
  $data = array(
    "a"   => 0,
    "op"  => '',
    "b"   => 0,
    "res" => 0);

    $data["a"] = intval($args[1]);
    $data["op"] = preg_replace('/\s+/', '', $args[2]);
    $data["b"] = intval($args[3]);
    return ($data);
}

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

function do_op($args)
{
  $op_tab = [
    '+' => 'sum',
    '-' => 'sust',
    '*' => 'mult',
    '/' => 'div',
    '%' => 'mod'
  ];

  $data = parse($args);
  echo $op_tab[$data['op']]($data)['res'];
}

if($argc == 4 and ( $argv[2] == '+' or
                    $argv[2] == '-' or
                    $argv[2] == '*' or
                    $argv[2] == '/' or
                    $argv[2] == '%'))
  do_op($argv);
else {
  echo 'Invalid Parameters';
}
 ?>
