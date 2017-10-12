#!/usr/bin/php
<?php
if  (file_exists("./ressources") == false)
	mkdir("./ressources");
if (file_exists("./ressources/user") == false)
	{
		echo "ok\n";
		$algo = "whirlpool";
		$login = "alban";
		$passwd = "123456";
		$tab["passwd"] = hash($algo, $passwd);
		$tab["email"] = "xyz";
		$tab["tel"] = "0123456789";
		$tab["adresse"] = "";
		$tab["lvl"] = "admin";
		$user[$login] = $tab;
		$algo = "whirlpool";
		$login = "feifan";
		$passwd = "123456";
		$tab["passwd"] = hash($algo, $passwd);
		$tab["email"] = "xyz";
		$tab["tel"] = "0123456789";
		$tab["adresse"] = "";
		$tab["lvl"] = "admin";
		$user[$login] = $tab;
		file_put_contents("./ressources/user", json_encode($user, true));
		//chmod("./ressources/users", )
	}
?>