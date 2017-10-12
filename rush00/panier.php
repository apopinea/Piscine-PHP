<?php
	session_start();
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
    <center>
<?php
	if ($_POST && $_POST[submit] === "Vider")
		unset ($_SESSION['panier']);

	$product = json_decode(file_get_contents('./ressources/product'), true);
	$total = 0;
	echo "<br />";
	if ($_SESSION['panier'])
	{
			foreach ($_SESSION['panier'] as $key) {
			foreach ($product as $k => $value) {
				if ($value['pname'] === $key[pname])
				{
					$prix = $value['prix'];
					break ;
				}
			}
			$total += $prix * $key[nb];
			echo "[".$key[pname]."] * ".$key[nb]." : ".$prix * $key[nb] ."$<br/>";
		}
	}
	if ($_SESSION['panier'])
	{
		$totalnb = 0;
		foreach ($_SESSION['panier'] as $key) {
			$totalnb += $key[nb];
		}
		echo "<br/> Vous avez ".$totalnb." produit dans votre panier.";
		echo "<br/> <br/>Cela vous cout en total : ".$total." $ <br/>";
		echo "<br /><form action='valid.php' method='POST'>"."<input type='submit' name='submit' value='Valider'/></form>";
		echo "<form action='panier.php' method='POST'>"."<input type='submit' name='submit' value='Vider'/></form>";
	} else {
		echo "<p> Votre panier est panier vide </p>";
	}
	echo "<br/><a href='index.php'>Retour</a>";
?>
</center>
</body>
</html>