<?php
function auth($login, $passwd)
{
	/*
	echo "login = " . $login ."<br/>";
	echo "login = " . $passwd ."<br/><br/>";	
	*/
	if (file_exists("../private/passwd") == false)
		return (false);
	$pass = hash("whirlpool", $passwd);
	$tab = unserialize(file_get_contents("../private/passwd"));
	foreach ($tab as $elem) 
	{
		/*
		echo "login = " . $elem['login'] ."<br/>";
		echo "mp = " . $elem['passwd'] ."<br/>";	
		*/
		if ($elem['login'] == $login && $pass == $elem['passwd'])
		{
			return (true);
		}
	}
	return (false);
}
?>