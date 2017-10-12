<?php
function auth($login, $passwd)
{
	if (file_exists("./ressources/user") == true)
	{
		$pass = hash("whirlpool", $passwd);
		$tab = json_decode(file_get_contents("./ressources/user"), true);
		foreach ($tab as $key => $elem)
		{
			/*
			echo "login = " . $elem['login'] ."<br/>";
			echo "mp = " . $elem['passwd'] ."<br/>";	
			*/
			if ($key == $login && $pass == $elem['passwd'])
			{
				$_SESSION["lvl"] = $elem["lvl"];
				return (true);
			}
		}
	}
	return (false);
}
?>