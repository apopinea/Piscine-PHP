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
	<section class="content">
		<?php

		if (file_exists('./ressources/product'))
		{
			$i = 0;
			$product = json_decode(file_get_contents('./ressources/product'), true);
			if ($product)
			{
				foreach ($product as $key) {
					echo '<div class="pbox">';
					echo "<a href='#'><img class='product_img' src=".$key[image].">";
					echo "<div class='product_text'>".$key[pname]."<br />"."&nbsp&nbsp&nbspde&nbsp".$key[pauteur];
					echo '<br \>'."Description : ".strtolower($key['des'][0]).'<br \>'.strtolower($key['des'][1]).'<br \>';
					echo "<form action='addpanier.php' method='POST'><input type='hidden' name='product' value='".$key[pname]."''>"."<input class='product_panier' type='submit' name='submit' value='panier'/></form>";
					echo "</a><p class='product_stock'>stock : ".$key[pnumber]."	</p></div>";
					echo "<p class='product_prix'>prix : ".$key[prix]."$</p></div>";
					echo '</div>';
					$i++;
					if ($i > 15)
						break;
				}
			}
		}
		?>
	</section>
	</body>
</html>