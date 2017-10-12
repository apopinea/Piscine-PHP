<?php
session_start();
header("refresh:5;url=index.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Amalib</title>
		<link rel="stylesheet" href="header.css">
		<meta name="author" content="apopinea">
		<meta name="author" content="fpeng">
		<meta name="keywords" content="book, livre, livres, librairie">
		<meta name="description" content="librairie en ligne">
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html">
		<!--<link rel="stylesheet" type="text/css" href="doft.css">-->
	</head>
	<body>
    <?php
    include "ban.php";
    ?>
<?php

if ($_POST && $_POST['submit'] && $_POST['submit'] === "panier" && $_POST['product'])
{

	$found = 0;

	if ($_SESSION[panier])
	{
		echo "<br />";
		foreach ($_SESSION[panier] as $key) {
			if ($key[pname] === $_POST['product'])
			{
				$prod = array();
				$prod["pname"] = $_POST['product'];
				$prod["nb"] = $key[nb] += 1;
				unset($_SESSION[panier][$_POST['product']]);
				$_SESSION['panier'][$_POST['product']] = $prod;
				$found = 1;
				break ;
			}
		}
	}
	if (!($found))
	{
		$prod = array();
		$prod["pname"] = $_POST['product'];
		$prod["nb"] = 1;
		$_SESSION['panier'][$_POST['product']] = $prod;
	}
	echo "<p>". $_POST['product'] ." bien ajouter a votre panier</p>";
}
else
	echo "fail";
echo "Vous allez etre rediriger dans 5sec <br />";
echo "<a href='index.php'>Retour</a";
?>
</body>
</html>