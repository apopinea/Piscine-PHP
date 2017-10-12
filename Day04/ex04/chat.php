<?php
session_start();
if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
{
	date_default_timezone_set('Europe/Paris');
	if (file_exists("../private/chat") == TRUE)
	{
		$fd = fopen("../private/chat", "c+");
		flock($fd, LOCK_SH);
		$str2 = fread($fd, filesize("../private/chat"));
		$tab = unserialize($str2);
		flock($fd, LOCK_UN);
		fclose($fd);
		foreach ($tab as $value) 
		{
			echo "<br>[";
			echo date("H:i", $value['time']);
			echo "] ";
			echo "<b>";
			echo $value['login'];
			echo "</b>: ";
			echo $value['msg'];
			echo "<br />";
		}
	}
}
?>