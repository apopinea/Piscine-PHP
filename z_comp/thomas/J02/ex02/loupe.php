#!/usr/bin/php
<?php
if ($argc == 2)
{

  $filename = $argv[1];
  if(!($fd = fopen($filename, 'r')))
  {
    echo $filename . " : file not found\n";
    exit(-1);
  }
  while ($fd && !feof($fd))
  {
    $str .= fgets($fd);
  }

  $str = preg_replace_callback("/(<a )(.*?)(>)(.*)(<\/a>)/si", function($matches) {
        $matches[0] = preg_replace_callback("/( title=\")(.*?)(\")/mi", function($matches) {
            return ($matches[1]."".strtoupper($matches[2])."".$matches[3]);
        }, $matches[0]);
        $matches[0] = preg_replace_callback("/(>)(.*?)(<)/si", function($matches) {
            return ($matches[1]."".strtoupper($matches[2])."".$matches[3]);
        }, $matches[0]);
        return ($matches[0]);
    }, $str);
  echo $str;

  fclose($fd);
}
?>