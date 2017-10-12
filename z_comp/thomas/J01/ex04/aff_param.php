#!/usr/bin/php
<?php
$first = true;
foreach ($argv as $arg) {
  if ($first){
     $first = false;
     continue;
  }
  echo $arg . "\n";
}
?>
