#!/usr/bin/php
<?php
$i = true;
foreach ($argv as $val)
{
	if($i)
		$i = false;
	else
		echo $val . "\n";
}
?>