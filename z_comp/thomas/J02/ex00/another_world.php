#!/usr/bin/php
<?php
function ft_split($str)
{
  return (preg_split("/\\s+/",$str, -1, PREG_SPLIT_NO_EMPTY));
}
function ft_merge($arr)
{
  $line = implode(" ", $arr);
  return ($line);
}
function epur($str)
{
    $arr = ft_split($str);
    return (ft_merge($arr));
}

if ($argc >= 2)
  echo epur($argv[1]).PHP_EOL;

?>