<?php
  $g_action = strip_tags($_GET['action']);
  $g_name = strip_tags($_GET['name']);
  $g_value = strip_tags($_GET['value']);
  switch ($g_action) {
    case 'get':
		if ($g_name && $_COOKIE[$g_name])
      echo $_COOKIE[$g_name].PHP_EOL;
      break;
    case 'set':
		 if ($g_value && $g_name)
		 	setcookie($g_name, $g_value, time() + 3600);
		 break;
    case 'del':
		 if ($g_name)
      setcookie($g_name, '', time() - 3600);
     break;
    default:
      break;
  }

?>
