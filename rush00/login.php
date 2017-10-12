<?php
require_once("auth.php");
session_start();
if (isset($_POST["conect"]) && $_POST["conect"] == "Connection")
{
	if (auth($_POST["login"], $_POST["passwd"]))
	{
		unset($_SESSION["loggued_error"]);
		$_SESSION["loggued_on_user"] = strip_tags($_POST["login"]);
		header("Location: index.php");
	}
	else
	{
		$_SESSION["loggued_error"] = "error";
		header("Location: index.php");
	}
}
else
{
	$login_str = "   (tappez login)";
	$passwd_str = "   (6 a 20 caracteres)";
	$rpasswd_str = "   (verification passe word)";
	if (isset($_POST["creer_compte"]) && $_POST["creer_compte"] == "Creer compte")
	{
		$login = strip_tags($_POST["login"]);
		$passwd = strip_tags($_POST["passwd"]);
	}
	else if (isset($_SESSION["error_create_cmpt"]) && $_SESSION["error_create_cmpt"] != "")
	{
		if (($_SESSION["error_create_cmpt"]["etat"] & 0b1) == 0 && ($_SESSION["error_create_cmpt"]["etat"] & 0b100000) == 0)
			$login = $_SESSION["error_create_cmpt"]["login"];
		else if (($_SESSION["error_create_cmpt"]["etat"] & 0b1) != 0)
			$login_str_e = "login incorrect.";
		else
			$login_str_e = "login existant.";
		if (($_SESSION["error_create_cmpt"]["etat"] & 0b10) == 0)
			$passwd = $_SESSION["error_create_cmpt"]["passwd"];
		else
			$passwd_str_e = "mot de passe incorrect.";
		if (($_SESSION["error_create_cmpt"]["etat"] & 0b100) == 0 && ($_SESSION["error_create_cmpt"]["etat"] & 0b10) == 0)
			$rpasswd = $_SESSION["error_create_cmpt"]["rpasswd"];
		else if (($_SESSION["error_create_cmpt"]["etat"] & 0b100) != 0 )
			$rpasswd_str_e = "les mot de passe sont different";
		if (($_SESSION["error_create_cmpt"]["etat"] & 0b1000) == 0)
			$email = $_SESSION["error_create_cmpt"]["email"];
		else
			$email_str_e = "email incorrect";
		if (($_SESSION["error_create_cmpt"]["etat"] & 0b10000) == 0)
			$tel = $_SESSION["error_create_cmpt"]["tel"];
		else
			$tel_str_e = "phone number incorrect";
		$adresse = $_SESSION["error_create_cmpt"]["adresse"];
		unset($_SESSION["error_create_cmpt"]);
	}
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<title>Book</title>
			<meta name="author" content="apopinea">
			<meta name="author" content="fpeng">
			<meta name="keywords" content="book, livre, livres, librairie">
			<meta name="description" content="librairie en ligne">
			<meta charset="UTF-8">
			<meta http-equiv="content-type" content="text/html">
			<!--<link rel="stylesheet" type="text/css" href="doft.css">-->
			<link rel="stylesheet" href="header.css">
		</head>
		<body class="tmp_body">
			<?php
			include "ban.php";
			?>
			<form class="form_create_cmpt" action="create_cmpt.php" method="POST">
				<table>
					<tr>
						<td>
							<label for="login">Identifiant *</label>
						</td>
						<td>
							<input type="text" name="login" id="login" value="<?php echo $login; ?>">
						</td>
						<td>
							<span><?php echo $login_str_e; ?></span>
							<span><?php echo $login_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="passwd">Mot de passe *</label>
						</td>
						<td>
							<input type="password" name="passwd" id="passwd" value="<?php echo $passwd; ?>">
						</td>
						<td>
							<span><?php echo $passwd_str_e; ?></span>
							<span><?php echo $passwd_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="rpasswd">Retaper mot de passe *</label>
						</td>
						<td>
							<input type="password" name="rpasswd" id="rpasswd" value="<?php echo $rpasswd; ?>">
						</td>
						<td>
							<span><?php echo $rpasswd_str_e; ?></span>
							<span><?php echo $rpasswd_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="email">Email *</label>
						</td>
						<td>
							<input type="email" name="email" id="email" value="<?php echo $email; ?>">
						</td>
						<td>
							<span><?php echo $email_str_e; ?></span>
							<span><?php echo $email_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="tel">Telephone *</label>
						</td>
						<td>
							<input type="tel" name="tel" id="tel" value="<?php echo $tel; ?>">
						</td>
						<td>
							<span><?php echo $tel_str_e; ?></span>
							<span><?php echo $tel_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<label for="adresse">Adresse</label>
						</td>
						<td>
							<input type="adresse" name="adresse" id="adresse" value="<?php echo $adresse; ?>">
						</td>
						<td>
							<span><?php echo $adresse_str_e; ?></span>
							<span><?php echo $adresse_str; ?></span>
						</td>
					</tr>
					<tr>
						<td>
							<input type="submit" name="create_cmpt" value="OK">
						</td>
					</tr>
					<tr>
						<td>
							<span>* : champ obligatoire</span>
						</td>
					</tr>
				</table>
			</form>
		</body>
	</html>
<?php
}
?>
