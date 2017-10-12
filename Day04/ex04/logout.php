<?php
session_start();
//echo "pre \$_SESSION : " . $_SESSION["loggued_on_user"] . "<br/>";
$_SESSION['loggued_on_user'] = "";
//echo "post \$_SESSION : " . $_SESSION["loggued_on_user"] . "<br/>";
header("Location: index.html");
?>
