<?php
include ('auth.php');
session_start();
/*
echo "\$_GET = <br/>";
print_r($_GET);
echo "<br/><br/>";
*/
if (auth($_GET['login'], $_GET['passwd']) == TRUE)
{
	$_SESSION['loggued_on_user'] = $_GET['login'];
	echo "OK\n";
}
else
{
	$_SESSION['loggued_on_user'] = "";
	echo "ERROR\n";
}
?>