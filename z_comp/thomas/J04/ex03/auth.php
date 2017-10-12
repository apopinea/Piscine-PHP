<?php
function auth($login, $passwd)
{
  $filename = "passwd";
  $path = "../private/";
  if (!isset($login) || !isset($passwd) || !file_exists($path.$filename))
    return FALSE;
  if ($login == "" || $passwd == "")
    return FALSE;
  $raw_file = unserialize(file_get_contents($path.$filename));
  $hashed_pw = hash("whirlpool", $passwd);
  $index = array_search($login, array_column($raw_file, 'login'));
  if ($raw_file[$index]['passwd'] == $hashed_pw)   {
    return TRUE;
  }
  else {
      return FALSE;
  }
}
 ?>
