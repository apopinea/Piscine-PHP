#!/usr/bin/php
<?php
function ft_split($str)
{
  return ((preg_split("#\s+#",$str, -1, PREG_SPLIT_NO_EMPTY)));
}

$ss = fgets(STDIN);
print_r(ft_split($ss));

?>
