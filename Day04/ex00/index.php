<?php
session_start();

$sub = $_GET["submit"];
if (isset($sub) && $sub === "OK")
{
	$_SESSION["login"] = $_GET["login"];
	$_SESSION["passwd"] = $_GET["passwd"];
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta name="author" content="apopinea">
		<meta name="keywords" content="php, piscine">
		<meta name="description" content="day04 ex00">
		<meta charset="UTF-8">
		<meta http-equiv="content-type" content="text/html">
		<style type="text/css">
		</style>
	</head>
	<body>
		<section class="section_principal">
			<form action="index.php" method="GET">
				<label for="login">Identifiant</label> : <input type="text" name="login" id="login" value="<?php if ($_SESSION["login"] != null && $_SESSION["login"] != "") {echo $_SESSION["login"];}?>">
				<br/>
				<label for="passwd">Mot de passe</label> : <input type="password" name="passwd" id="passwd" value="<?php if ($_SESSION["passwd"] != null && $_SESSION["passwd"] != "") {echo $_SESSION["passwd"];}?>">
				<br/>
				<input type="submit" name="submit" value="OK">
				<br/>
			</form>
		</section>
	</body>
</html>
<?php
/*
echo "<br/>\$_SESSION : <br/>";
print_r($_SESSION);
echo "<br/><br/>";
echo "\$_GET : <br/>";
print_r($_GET);
*/
?>