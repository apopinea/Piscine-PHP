#!/usr/bin/php
<?php
function ft_split($s1)
{
	//$tab = array_filter(explode(" ", $s1), strlen);
	$tab = preg_split("# +#",$s1, -1, PREG_SPLIT_NO_EMPTY);
	if ($tab != NULL)
		sort($tab);
	return ($tab);
}
?>