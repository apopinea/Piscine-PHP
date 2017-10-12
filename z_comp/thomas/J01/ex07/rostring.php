#!/usr/bin/php
<?php
function ft_split($str)
{
  return (preg_split("/\\s+/",$str, -1, PREG_SPLIT_NO_EMPTY));
}

function ft_merge($arr)
{
  $line = implode(" ", $arr);
  return ($line . PHP_EOL);
}
function ft_strputback($str)
{
  $arr = ft_split($str);
  $arr[count($arr)] = $arr[0];
  array_shift($arr);
  return (ft_merge($arr));
}

echo ft_strputback($argv[1]);
 ?>
