<?php
session_start();
$them_act = strip_tags($_GET["theme"]);
$time_tri = strip_tags($_GET["time"]);
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
    <nav class="nav_theme">
    	<br/>
    	<h2>Date ajout</h2>
    	<a href="theme.php?theme=<?php echo $them_act; ?>&time=plus">Nouveau</a>
    	<br>
    	<a href="theme.php?theme=<?php echo $them_act; ?>&time=moin">Ancien</a>
    	<br><br>
    	<h2>Themes :</h2>
    	<?php
    	$cate = array();
    	$tab = json_decode(file_get_contents('./ressources/product'), true);
    	/*
    	echo "<br>tab = <br>";
    	print_r($tab);
    	echo "<br><br>";
    	*/
    	foreach ($tab as $val_tab)
    	{
    		$tmp = explode(";", $val_tab["cate"]);
    		foreach ($tmp as $val_tmp)
    		{
    			if (in_array($val_tmp, $cate) == false)
    			{
    				$cate[] = $val_tmp;
    			}
    		}
    	}
    	/*
    	echo "<br>cate = <br>";
    	print_r($cate);
    	echo "<br><br>";
    	*/
    	foreach ($cate as $elem)
    	{
    		?>
    			<div><a href="theme.php?theme=<?php echo $elem; ?>&time=<?php echo $time_tri ?>"> <?php echo $elem; ?></a></div>
    		<?php
    	}
    	?>
   	</nav>
   	<section class="content2">
		<?php

		if (file_exists('./ressources/product'))
		{
			$i = 0;
			$product = json_decode(file_get_contents('./ressources/product'), true);
			if (isset($_GET["theme"]) && $_GET["theme"] != "")
			{
				foreach ($product as $key => $val_prod)
				{
					/*
					echo "<br> key = " . $key;;
					echo "<br>val_prod = ";
					print_r($val_prod);
					echo "<br><br>";
					*/
					$tmp = explode(";", $val_prod["cate"]);
					if (in_array($_GET["theme"], $tmp) == false)
					{
						unset($product[$key]);
					}
				}
			}
			
			if ($time_tri == "moin")
			{
				$tab_tri_key = array_column($product, "time", "pname");
				if ($tab_tri_key != null)
					asort($tab_tri_key);
			}
			else
			{
				$tab_tri_key = array_column($product, "time", "pname");
				if ($tab_tri_key != null)
					arsort($tab_tri_key);
			}
			/*
			echo "<br>tab_tri_key = ";
			print_r($tab_tri_key);
			echo "<br><br>";
			*/
			foreach ($tab_tri_key as $key_tri => $val_tri)
			{
				?>
				<div class="pbox">
					<a href='#'><img class='product_img' src="<?php echo $product[$key_tri]['image']; ?>"></a>
					<div class='product_text'>
						<?php echo $product[$key_tri]["pname"]; ?>
						<br />
						de&nbsp <?php echo $product[$key_tri]["pauteur"]; ?>
						<br \>
						Description : <?php echo strtolower($product[$key_tri]['des'][0]); ?>
						<br \>
						<?php echo strtolower($product[$key_tri]['des'][1]); ?>
						<br \>
						<form action='addpanier.php' method='POST'>
							<input type='hidden' name='product' value=<?php echo $product[$key_tri]["pname"]; ?>>
							<input class='product_panier' type='submit' name='submit' value='panier'/>
						</form>
						<p class='product_stock'>stock : <?php echo $product[$key_tri]["pnumber"]; ?></p>
						<p class='product_prix'>prix : <?php echo $product[$key_tri]["prix"]; ?>$</p>
					</div>
				</div>
				<?php
			}
		}
		?>
	</section>
	</body>
</html>