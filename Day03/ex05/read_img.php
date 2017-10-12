<?php
	$img_name = "../img/42.png";
	header('Content-Type:image/png');
	// header('Content-Length: '.filesize($img_name));
	readfile($img_name);
?>