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
  print(ft_merge(ft_split($argv[1])));
?>
