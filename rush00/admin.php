<?php
session_start();
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && isset($_SESSION["lvl"]) && $_SESSION["lvl"] == "admin")
{
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
		<section class="content">
			<form action="admin.php" method="POST">
				<input type="submit" name="Add_product" value="gestion product">
				<input type="submit" name="Commandes" value="Commandes">
			</form>
			<?php
			/*
			echo "post = <br>";
			print_r($_POST);
			echo "<br><br> session = <br>";
			print_r($_SESSION);
			*/
			if ((isset($_POST["Add_product"]) && $_POST["Add_product"] == "gestion product") || (isset($_SESSION["add_product"]) && $_SESSION["add_product"] != "") || ( isset($_SESSION["modif_product"]) && $_SESSION["modif_product"] != ""))
			{
				echo "<span>". $_SESSION["modif_product"] . $_SESSION["add_product"] ."</span>";
				include "addproduct.html";
			}
			unset($_SESSION["modif_product"]);
			unset($_SESSION["add_product"]);
			if (((isset($_POST[Commandes]) && ($_POST[Commandes] === "Commandes"))))
			{
				echo "<br/><br/>";
				if (!(file_exists("./ressources/commande")))
					file_put_contents('./ressources/commande', null);
					$commande = json_decode(file_get_contents('./ressources/commande'), true);
					$user = json_decode(file_get_contents('./ressources/user'), true);
					if (!($commande))
						echo "Pas de commande..<br />";
					else
					{
						foreach ($commande as $key) {
							echo "User [".$key[uname]."] adresse: ". $user[$key[uname]][adresse]." | tel: ".$user[$key[uname]][tel].":<br/>";
							foreach ($key as $p) {
								if ( $p != $key["uname"])
								{
									echo "[".$p["pname"]."] * ".$p["nb"]."<br />";
								}
							}
							echo "<br />";
						}	
					}
			}
			?>
		</section>
		</body>
	</html>
	<?php
}
?>