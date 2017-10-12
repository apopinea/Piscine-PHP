#!/usr/bin/php
<?php
if ($argc == 2)
{
  $page = $argv[1];

  ini_set("allow_url_fopen",true);
  shell_exec("mkdir -p " . $page);
  $fd = curl_init();
  curl_setopt($fd, CURLOPT_URL, "http://".$page);
  curl_setopt($fd, CURLOPT_HEADER, 0);
  curl_setopt($fd, CURLOPT_RETURNTRANSFER, 1);
  $str = curl_exec($fd);


  while (preg_match('/(<img[^>]+>)/i', $str, $matches))
  {
    $pos = strrpos($str, $matches[0]);
    $str = substr($str, $pos + strlen($matches[0]));

    preg_match('/src="(.*?)"/', $matches[0], $match2);
    preg_match('/[\w\-]+\.(jpg|png|gif|jpeg|svg)/', $match2[1], $name);

    if (strpos($matches[0], "http") == true)
    {
      copy($match2[1], $page . '/' . $name[0]);
    }
    else
    {
      copy('http://www.42.fr' . $match2[1], $page. '/' . $name[0]);
    }
  }
curl_close($fd);
}
?>