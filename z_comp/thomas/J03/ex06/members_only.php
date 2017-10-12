<?php

	if ($_SERVER['PHP_AUTH_USER'] == "zaz"
	   && $_SERVER['PHP_AUTH_PW'] == "jaimelespetitsponeys")
	{
		$img_b64 = base64_encode(file_get_contents("../img/42.png"));
		echo "<html><body>".PHP_EOL;
		echo "Bonjour Zaz<br />".PHP_EOL;
		echo "<img src='data:image/png;base64,$img_b64'>".PHP_EOL;
		echo "</body></html>".PHP_EOL;
	}
	else
	{
		header('HTTP/1.0 401 Unauthorized');
		header("WWW-Authenticate: Basic realm=''Espace membres''");
		header('Content-Type: text/html');
		echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>".PHP_EOL;
	}
?>
