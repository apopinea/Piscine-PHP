<?php
session_start();
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && isset($_SESSION["lvl"]))
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
			<?php
			if (file_exists("./ressources/user"))
			{
				$tab = json_decode(file_get_contents("./ressources/user"), true);
			}
			/*
			echo "<br>tab = <br>";
			print_r($tab);
			echo "<br><br>";
			*/
			?>
			<table>
				<thead>
					<th colspan="2">
						info compte
					</th>
				</thead>
				<tr>
					<td>
						login : 
					</td>
					<td>
						<?php echo $_SESSION["loggued_on_user"]; ?>
					</td>
				</tr>
				<tr>
					<td>
						email : 
					</td>
					<td>
						<?php echo $tab[$_SESSION["loggued_on_user"]]["email"]; ?>
					</td>
				</tr>
				<tr>
					<td>
						adresse : 
					</td>
					<td>
						<?php echo $tab[$_SESSION["loggued_on_user"]]["adresse"]; ?>
					</td>
				</tr>
				<tr>
					<td>
						tel : 
					</td>
					<td>
						<?php echo $tab[$_SESSION["loggued_on_user"]]["tel"]; ?>
					</td>
				</tr>
			</table>
			<?php
			if ($_POST["suprimer"] != "suprimer")
			{
			?>
			<form action="my_cmpt.php" method="POST">
				<input type="submit" name="suprimer" value="suprimer">
				<input type="submit" name="modifier" value="modifier">
			</form>
			<?php
			}
			if ($_POST["modifier"] == "modifier")
			{
				?>
				<form action="modif_cmpt.php" method="POST">
				<table>
					<tr>
						<td>
							<label for="passwd">Mot de passe </label>
						</td>
						<td>
							<input type="password" name="passwd" id="passwd" value="<?php echo $passwd; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email </label>
						</td>
						<td>
							<input type="email" name="email" id="email" value="<?php echo $email; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="tel">Telephone </label>
						</td>
						<td>
							<input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<label for="adresse">Adresse</label>
						</td>
						<td>
							<input type="adresse" name="adresse" id="adresse" value="<?php echo $adresse; ?>">
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="modif_cmpt" value="OK">
						</td>
					</tr>
					<tr>
						<td>
							<span>* : champ obligatoire</span>
						</td>
					</tr>
				</table>
				</form>
				<?php
			}
			if ($_POST["suprimer"] == "suprimer")
			{
				?>
				<form action="my_cmpt.php" method="POST">
					<input type="submit" name="annuler" value="annuler">
				</form>
				<form action="sup_cmpt.php" method="POST">
					<input type="submit" name="confirm_suprimer" value="confirmer suprimer">
				</form>
				<?php
			}
			?>
		</section>
		</body>
	</html>
	<?php
}
?>