<?php
$action = strip_tags($_GET["action"]);
$name = strip_tags($_GET["name"]);
if ($action == 'get')
{
	$cook = strip_tags($_COOKIE[$name]);
	if (isset($cook) && $cook)
	{
		echo $cook . "\n";
	}
}
else if ($action == 'set')
{
	$value = strip_tags($_GET["value"]);
	if (isset($name) && isset($value))
	{
		setcookie($name, $value, time() + 3600000);
	}
}
else if ($action == 'del')
{
	setcookie($name, "", time() - 3600);
}
?>