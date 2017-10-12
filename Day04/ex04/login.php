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
	?>
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>
		<br/>
		<form action="logout.php" method="GET">
			<br/>
			<input type="submit" name="OK_deco" value="DECO">
			<br/>
		</form>
	<?php
}
else
{
	$_SESSION['loggued_on_user'] = "";
	echo "ERROR\n";
}
?>