<?php
$path = "../private/";
$filename = "passwd";

if ($_POST['submit'] == "OK")
{
    if (isset($_POST['login']) && isset($_POST['passwd']) &&
      $_POST['login'] != "" && $_POST['passwd'] != "")
    {
      $hashedPWD = hash("whirlpool", $_POST['passwd']);
      $data = array('login' => $_POST['login'], 'passwd' => $hashedPWD);
      if (!file_exists($path.$filename))
      {
        mkdir($path);
        $arr = array();
        $arr[] = $data;
        file_put_contents($path.$filename, serialize($arr));
        echo "OK".PHP_EOL;
      }
      else {
        $raw_file = unserialize(file_get_contents($path.$filename));
        if (in_array($_POST['login'], $raw_file))
          echo "ERROR".PHP_EOL;
        else {
          $raw_file[] = $data;
          file_put_contents($path.$filename, serialize($raw_file));
          echo "OK".PHP_EOL;
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
