<?PHP
	foreach($_GET as $param => $v)
	{
		printf("%s: %s\n", strip_tags($param), strip_tags($v));
	}
?>