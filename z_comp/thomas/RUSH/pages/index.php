<?PHP
include('auth.php');
session_start();
if ($_POST['logout'] && $_POST['logout'] === 'LOG OUT')
{
	$_SESSION = array();
	session_destroy();
}
if	($_SESSION['status'] === "logged")
{
	header("Location: home.php");
	exit;
}
if	($_POST['nolog'] === "ENTER WITHOUT LOG IN")
{
	$_SESSION['status'] = "notlogged";
	header("Location: home.php");
	exit;
}
else if ($_POST['submit'] === "LOG IN")
{
	if ($_POST['login'] &&
		$_POST['pwd'] &&
		auth($_POST['login'], $_POST['pwd']))
	{
		$_SESSION['logged_on_user'] = $_POST['login'];
		$_SESSION['status'] = "logged";
		header("Location: home.php");
		exit;
	}
	else
		$wrong = 1;
}
else if ($_POST['nsubmit'] === "REGISTER")
{
	$ret = 0;
	if ($_POST['nlogin'] &&
		$_POST['npwd'] &&
		$_POST['name'] &&
		$_POST['last'] &&
		$_POST['mail'] &&
		$_POST['addr'] &&
		$_POST['tel'])
	{
          $p_name = strip_tags($_POST['name']);
          $p_last = strip_tags($_POST['last']);
          $p_nlogin = strip_tags($_POST['nlogin']);
          $p_mail = strip_tags($_POST['mail']);
          $p_tel = strip_tags($_POST['tel']);
          $p_addr = strip_tags($_POST['addr']);
          $p_npwd = strip_tags($_POST['npwd']);
		$ret = create(
			$p_nlogin,
			$p_npwd,
			$p_name,
			$p_last,
			$p_mail,
			$p_addr,
			$p_tel);
	}
	else
		$wrong = 1;
	if ($ret > 0)
	{
		$_SESSION['logged_on_user'] = $_POST['nlogin'];
		$_SESSION['status'] = "logged";
		header("Location: home.php");
		exit;
	}
}
?>
<!DOCTYPE html>
<HTML>
	<HEAD>
		<link rel="stylesheet" type="text/css" href="doft.css">
		<TITLE>The Pirate Bay</TITLE>
	</HEAD>
	<BODY>
		<div style="width:100%; height:100%">
			<div style="background-color: grey; height:90%; margin:auto; padding:10px; border:solid; border-color:black; text-align:center;">
				<font size="10" color="gold">The Pirate Bay</font><br/>
		<form method="POST" action="index.php">
			<input type="submit" name="nolog" value="ENTER WITHOUT LOG IN"><br/>
		</form>
			<div style="background-color:#000000; height:60%; margin:auto; padding:10px; border:solid; border-color:black; text-align:center;">
		<form method="POST" action="index.php">
			<font color="white">Username:</font><br/>
			<input type="text" name="login"><br/>
			<font color="white">Password:</font><br/>
			<input type="password" name="pwd"><br/>
			<input type="submit" name="submit" value="LOG IN"><br/>
		</form>
			</div>
				<font size="6">New Users</font><br/>
		<form method="POST" action="index.php">
			First Name:<br/>
			<input type="text" name="name"><br/>
			Last Name:<br/>
			<input type="text" name="last"><br/>
			E-Mail<br/>
			<input type="text" name="mail"><br/>
			Tel<br/>
			<input type="text" name="tel"><br/>
			Address<br/>
			<input type="text" name="addr"><br/>
			Username:<br/>
			<input type="text" name="nlogin"><br/>
			Password:<br/>
			<input type="password" name="npwd"><br/>
			<input type="submit" name="nsubmit" value="REGISTER"><br/>
		</form>
<?PHP
if ($wrong == 1)
{?>
<center><?PHP echo "Wrong information"; ?></center>
<?} else if ($ret === -1)
{?>
<center><?PHP echo "User or Mail already exist";
}?></center>
			</div>
		</div>
	</BODY>
</HTML>
