<?php
$path = "../private/";
$filename = "passwd";

if ($_POST['submit'] == "OK")
{
  if (isset($_POST['login']) &&
      isset($_POST['oldpw']) &&
      isset($_POST['newpw']))
      {
        $p_login = strip_tags($_POST['login']);
        $p_oldpw = strip_tags($_POST['oldpw']);
        $p_newpw = strip_tags($_POST['newpw']);
      }

    if ($p_login != "" &&
        $p_oldpw != "" &&
        $p_newpw != "" &&
        $p_newpw != $p_oldpw)
    {

      $hashed_new_PWD = hash("whirlpool", $p_newpw);
      $hashed_old_PWD = hash("whirlpool", $p_oldpw);
      if (!file_exists($path.$filename))
        echo "ERROR file missing".PHP_EOL;
      else {
        $raw_file = unserialize(file_get_contents($path.$filename));
        $index = array_search($p_login, array_column($raw_file, 'login'));
        if (in_array($p_login, array_column($raw_file, 'login')) &&
              $hashed_old_PWD == $raw_file[$index]['passwd']) {
            $raw_file[$index]['passwd'] = $hashed_new_PWD;
            file_put_contents($path.$filename, serialize($raw_file));
            echo "OK".PHP_EOL;

          }
        else {
          echo "ERROR".PHP_EOL;
        }
      }
    }
    else {
      echo "ERROR".PHP_EOL;
    }
}
else {
  echo "ERROR".PHP_EOL;
}
?>
