<?php
session_start();
/*
echo "<br>session = <br>";
print_r($_SESSION);
echo "<br><br>";
session_start();
echo "<br>post = <br>";
print_r($_POST);
echo "<br><br>";
*/
if(isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && isset($_POST["modif_cmpt"]) && $_POST["modif_cmpt"] == "OK")
{
	if (file_exists("./ressources/user") == true)
	{
		$tab = json_decode(file_get_contents("./ressources/user") , true);
		/*
		echo "<br>tab = <br>";
		print_r($tab);
		echo "<br><br>";
		*/
		foreach ($tab as $key => $value)
		{
			if ($key == $_SESSION["loggued_on_user"])
			{
				$email = strip_tags($_POST["email"]);
				$passwd = strip_tags($_POST["passwd"]);
				$tel = strip_tags($_POST["tel"]);
				$adresse = strip_tags($_POST["adresse"]);
				if (isset($email) && $email != "")
					$tab[$_SESSION["loggued_on_user"]]["email"] = $email;
				if (isset($passwd) && $passwd != "")
					$tab[$_SESSION["loggued_on_user"]]["passwd"] = hash("whirlpool", $passwd);
				if (isset($tel) && $tel != "")
					$tab[$_SESSION["loggued_on_user"]]["tel"] = $tel;
				if (isset($adresse) && $adresse != "")
					$tab[$_SESSION["loggued_on_user"]]["adresse"] = $adresse;
				/*
				echo "<br> post tab = <br>";
				print_r($tab);
				echo "<br><br>";
				*/
				file_put_contents("./ressources/user", json_encode($tab, true));
				break ;
			}
		}
	}
}
header("Location: my_cmpt.php");
?>