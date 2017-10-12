#!/usr/bin/php
<?php
if ($argc == 2)
{
	$page = $argv[1];
	ini_set("allow_url_fopen",true);
	$tab = preg_split("#//#", $page, 2);
	print_r($tab);
	
	$fd = curl_init();
	//curl_setopt($process, CURLOPT_TIMEOUT, 30); 
	//$user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)'; 
	curl_setopt($fd, CURLOPT_URL, $page);
	//curl_setopt($process, CURLOPT_USERAGENT, $user_agent);
  	curl_setopt($fd, CURLOPT_HEADER, 0);
 	curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
 	if ( ! $str = curl_exec($fd))
 	{
 		echo "error url\n";
 		curl_close($fd);
 		return (0);
 	}
 	preg_match_all("#<img[^>]*>#s", $str, $tt);
 	echo "\n\ntout les <img>\n";
 	print_r($tt);
 	if (file_exists($tab[1]) === false)
		mkdir($tab[1], 0777, true);
	foreach ($tt[0] as $value)
	{
		preg_match('#src="([^"]+)"#', $value, $cc);
		echo "\n\nles src\n";
		print_r($cc);
		$pattern = "#^https?://#";
		$i = preg_match($pattern, $cc[1]);
		echo "\ni = ".$i."\n";
		echo "\n\n les name\n";
		preg_match("#/([^/]*)$#", $cc[1], $nnn);
		print_r($nnn);
		if ($i === false)
			return (0);
		else if ($i == 0)
		{
			$url2 = $page . $cc[1];
		}
		else if ($i == 1)
		{
			$url2 = $cc[1];
		}
		echo "tab[1] = ".$tab[1]."\n";
		echo "url = ".$url2."\n";
		file_put_contents($tab[1]. $nnn[0], file_get_contents($url2));
	}
	curl_close($fd);
}
?>