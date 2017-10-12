<?php
$filename = "passwd";
$path = "../private/";
include("auth.php");
if (isset($_GET['login']) &&
    isset($_GET['passwd']) &&
    $_GET['login'] != "" &&
    $_GET['passwd'] != "")
    {
      session_start();
      if (!file_exists($path.$filename) ||
          !auth(strip_tags($_GET['login']), strip_tags($_GET['passwd'])))
            {
              $_SESSION['loggued_on_user'] = "";
              echo "ERROR\n";
            }
      else
      {
        $_SESSION['loggued_on_user'] = strip_tags($_GET['login']);
        echo "OK\n";
      }
    }

 ?>
