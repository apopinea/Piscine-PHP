<?php
if (!isset($_POST["login"]) || $_POST["login"] == "" || !isset($_POST["oldpw"]) || $_POST["oldpw"] == "" || $_POST["submit"] != "OK" || !isset($_POST["newpw"]) || $_POST["newpw"] == "")
{
	echo "ERROR\n";
}
else
{
	$dir = "../private";
	$path = $dir . "/passwd";
	$log = strip_tags($_POST["login"]);
	$opass = strip_tags($_POST["oldpw"]);
	$npass = strip_tags($_POST["newpw"]);
	$algo = "whirlpool";
	if (!isset($log) || $log == "" || !isset($opass) || $opass == "" || !isset($npass) || $npass == "")
		echo "ERROR\n";
	else
	{
		if (file_exists($dir) === false)
		{
			echo "ERROR\n";
		}
		else
		{
			if (file_exists($path))
			{
				$tab = unserialize(file_get_contents($path));
				/*
				foreach ($tab as $value)
				{
					echo "<br/>log = ".$value["login"]."<br/>";
					echo "<br/>pass = ".$value["passwd"]."<br/>";
				}
				echo "<br/><br/>";
				*/
				$key = array_search($log, array_column($tab, "login"));
				if ($key !== false)
				{
					$opass2 = hash($algo, $opass);
					$opass_test = $tab[$key]["passwd"];
					$npass2 = hash($algo, $npass);
					if ($opass2 == $opass_test)
					{
						$tab[$key]["passwd"] = $npass2;
						/*
						foreach ($tab as $value)
						{
							echo "<br/>log = ".$value["login"]."<br/>";
							echo "<br/>pass = ".$value["passwd"]."<br/>";
						}
						*/
						file_put_contents($path, serialize($tab));
						//echo "OK\n";
						header("Location: index.html");
					}
					else
					{
						echo "ERROR\n";
					}
				}
				else
				{
					echo "ERROR\n";
				}
			}
			else
			{
				echo "ERROR\n";
			}
		}
	}
}
?>