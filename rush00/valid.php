<?php
	session_start();
	if (!($_SESSION["loggued_on_user"]))
		header( "refresh:5;url=login.php" );
	
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
	if (!($_SESSION["loggued_on_user"]))
	{
		echo "<br /> <p>Vous n'etes pas connecte, vous allez etre diriger vers le <a href=login.php>creation de compte</a><br />";
	}
	else if ($_POST && $_POST['submit'] === "Valider")
	{

		if (!(file_exists("./ressources/commande")))
			file_put_contents('./ressources/commande', null);
		$commande = json_decode(file_get_contents('./ressources/commande'), true);
		$product = json_decode(file_get_contents('./ressources/product'), true);
		$_SESSION[panier][uname] = $_SESSION["loggued_on_user"];
		foreach ($_SESSION[panier] as $key) {
			if (is_array($key))
			{
				foreach ($product as $k => $var){
					if ($var['pname'] === $key['pname'])
					{
						$product[$key['pname']]['pnumber'] -= $key['nb'];
						if ($product[$key['pname']][pnumber] < 0)
							exit("Error: stock vide");
						break ;	
					}
				}
			}
		}
		$commande[] = $_SESSION[panier];
		file_put_contents('./ressources/product', json_encode($product));
		file_put_contents('./ressources/commande', json_encode($commande));
		echo "<center><br />votre commande a bien etait valider <br />";
		unset($_SESSION[panier]);
		echo "Il va etre livree dans 2331.211 ans, merci ;)</center>";
	}
?>
</center>
</body>
</html>