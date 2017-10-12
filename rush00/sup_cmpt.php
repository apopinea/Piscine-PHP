<?php
session_start();
/*
echo "<br>session = <br>";
print_r($_SESSION);
echo "<br><br>";
session_start();
echo "<br>post = <br>";
print_r($_POST);
echo "<br><br>";
*/
if(isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && isset($_POST["confirm_suprimer"]) && $_POST["confirm_suprimer"] == "confirmer suprimer")
{
	//echo "<br>test<br>";
	$sup = "suppression error";
	if (file_exists("./ressources/user") == true)
	{
		$tab = json_decode(file_get_contents("./ressources/user") , true);
		foreach ($tab as $key => $value)
		{
			if ($key == $_SESSION["loggued_on_user"])
			{
				unset($tab[$key]);
				/*
				echo "<br>tab = <br>";
				print_r($tab);
				echo "<br><br>";
				*/
				file_put_contents("./ressources/user", json_encode($tab, true));
				$sup = "suppression effectuer";
				unset($_SESSION["loggued_on_user"]);
				break ;
			}
		}
	}
}
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
		<?php echo $sup; ?>
	</section>
	</body>
</html>
<?php
?>