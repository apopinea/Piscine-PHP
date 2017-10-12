<?php
if (!isset($_POST["login"]) || $_POST["login"] == "" || !isset($_POST["passwd"]) || $_POST["passwd"] == "" || $_POST["submit"] != "OK")
	echo "ERROR\n";
else
{
	$dir = "../private";
	$path = $dir . "/passwd";
	$log = strip_tags($_POST["login"]);
	$pass = strip_tags($_POST["passwd"]);
	$algo = "whirlpool";
	if (!isset($log) || $log == "" || !isset($pass) || $pass == "")
		echo "ERROR\n";
	else
	{
		if (file_exists($dir) === false)
			mkdir($dir, 0777, true);
		if (file_exists($path))
		{
			$tab = unserialize(file_get_contents($path));
			
			if (in_array($log, array_column($tab, "login")))
				echo "ERROR\n";
			else
			{
				$pass2 = hash($algo, $pass);
				$data = array("login" => $log, "passwd" => $pass2);
				$tab[] = $data;
				/*
				foreach ($tab as $value)
				{
					echo "<br/>log = ".$value["login"]."<br/>";
					echo "<br/>pass = ".$value["passwd"]."<br/>";
				}
				*/
				file_put_contents($path, serialize($tab));
				echo "OK\n";
			}
		}
		else
		{
			$pass2 = hash($algo, $pass);
			$data = array("login" => $log, "passwd" => $pass2);
			$tab = array($data);
			/*
			foreach ($tab as $value)
			{
				echo "<br/>log = ".$value["login"]."<br/>";
				echo "<br/>pass = ".$value["passwd"]."<br/>";
			}
			*/
			file_put_contents($path, serialize($tab));
			echo "OK\n";
		}
	}
}
?>