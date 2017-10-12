<?php
session_start();
if (isset($_POST["create_cmpt"]) && $_POST["create_cmpt"] == "OK")
{
	$algo = "whirlpool";
	$login = strip_tags($_POST["login"]);
	$passwd = strip_tags($_POST["passwd"]);
	$tab["passwd"] = hash($algo, $passwd);
	$rpasswd = strip_tags($_POST["rpasswd"]);
	$tab["email"] = strip_tags($_POST["email"]);
	$tab["tel"] = preg_replace("#[ \t]+#", "", strip_tags($_POST["tel"]));
	$tab["adresse"] = strip_tags($_POST["adresse"]);
	$tab["lvl"] = "base";
	$error = array();
	$error["etat"] = 0;
	if ($login == "")
		$error["etat"] |= 0b1;
	if (preg_match("#^.{6,20}$#", $passwd) != 1)
		$error["etat"] |= 0b10;
	if ($passwd != $rpasswd)
		$error["etat"] |= 0b100;
	if (preg_match("#^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]){2,6}#", $tab["email"]) != 1)
		$error["etat"] |= 0b1000;
	if (preg_match("#[0-9]{10}#", $tab["tel"]) != 1)
		$error["etat"] |= 0b10000;
	if ($error["etat"] == 0)
	{
		if  (file_exists("./ressources") == false)
			mkdir("./ressources");
		if (file_exists("./ressources/user") == false)
		{
			$user[$login] = $tab;
			file_put_contents("./ressources/user", json_encode($user, true));
			header("Location: index.php");
		}
		else
		{
			$fd = fopen("./ressources/user", "r+");
			flock($fd, LOCK_EX | LOCK_SH);
			$tmp = fread($fd, filesize("./ressources/user"));
			$old_user = json_decode($tmp, true);
			foreach ($old_user as $key => $value)
			{
				if ($key == $login)
				{
					$error["etat"] |= 0b100000;
					break ;
				}
			}
			if ($error["etat"] == 0)
			{
				$old_user[$login] = $tab;
				rewind($fd);
				$tmp = json_encode($old_user, true);
				fwrite($fd, $tmp);
				flock($fd, LOCK_UN);
				fclose($fd);
				header("Location: index.php");
			}
			else
			{
				flock($fd, LOCK_UN);
				fclose($fd);
				$error["login"] = $login;
				$error["passwd"] = $passwd;
				$error["rpasswd"] = $rpasswd;
				$error["email"] = $tab["email"];
				$error["tel"] = $tab["tel"];
				$error["adresse"] = $tab["adresse"];
				$_SESSION["error_create_cmpt"] = $error;
				header("Location: login.php");
			}
		}
	}
	else
	{
		$error["login"] = $login;
		$error["passwd"] = $tab["passwd"];
		$error["rpasswd"] = $rpasswd;
		$error["email"] = $tab["email"];
		$error["tel"] = $tab["tel"];
		$error["adresse"] = $tab["adresse"];
		$_SESSION["error_create_cmpt"] = $error;
		//print_r($_SESSION);
		header("Location: login.php");
	}
}
else
{
	header("Location: index.php");
}
?>