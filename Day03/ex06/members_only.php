<?php
$user = $_SERVER['PHP_AUTH_USER'];
$mp = $_SERVER['PHP_AUTH_PW'];
if ($user == "zaz" && $mp == "jaimelespetitsponeys")
{
	$img_b64 = base64_encode(file_get_contents("../img/42.png"));
	echo "<html><body>\nBonjour Zaz<br />\n<img src='data:image/png;base64," . $img_b64 . "'>\n</body></html>\n";
}
else
{
	header("WWW-Authenticate: Basic realm=''Espace membres''");
	header('HTTP/1.0 401 Unauthorized');
	header('Content-Type: text/html');
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
}
?>