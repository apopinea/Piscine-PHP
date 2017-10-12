#!/usr/bin/php
<?php

function ft_split($str)
{
  return (preg_split("/\\s+/",$str, -1, PREG_SPLIT_NO_EMPTY));
}

$first = true;
$u = array();
foreach ($argv as $arg) {
  if ($first)
  {
    $first = false;
    continue ;
  }
  $tmp = ft_split($arg);
  if (count($tmp) > 1)
  {
    foreach ($tmp as $w) {
      array_push($u, $w);
    }
    continue;
  }
  array_push($u, $tmp[0]);
}
asort($u);
foreach ($u as $e) {
  echo $e . PHP_EOL;
}
 ?>
