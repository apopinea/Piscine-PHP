<?php
session_start();
header("refresh:1;url=index.php");
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "" && $_SESSION["lvl"] == "admin")
{
	if ($_POST["submit"] && ($_POST["submit"] === "Supprimer") && $_POST['pname'])
	{
        $product = json_decode(file_get_contents('./ressources/product'), true);
	        echo "<br/>";
        if (!($product))
 		{
        	echo "file Error<br />";
 			exit ();
    		}
    	foreach ($product as $key => $var) {
    		if ($var['pname'] === $_POST['pname'])
    			unset($product[$_POST['pname']]);
    	}
    	file_put_contents('./ressources/product', json_encode($product));
		echo "<br/>Deleted !<br/>";
	}

}	

?>