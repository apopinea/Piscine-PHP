<?php
function ft_is_sort($tab)
{
    if ($tab == null)
        return false;
    $tab2 = $tab;
    sort($tab2);
    for($i = 0 ; $i < count($tab) ; $i++)
    {
      if ($tab[$i] == $tab2[$i])
        continue ;
      else
        return false;
    }
    return true;
}

?>
