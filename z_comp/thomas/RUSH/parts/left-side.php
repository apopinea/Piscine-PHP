<?php
// Generate left-column
//interoge la base de donnee pour recuperer les categories
$_db_path = "../DB/";
$_db_items = "db_items.json";
$_db_users = "db_users.json";
$profiles = json_decode(file_get_contents($_db_path.$_db_users), TRUE);
$idy = array_search($_SESSION['logged_on_user'], array_column($profiles, 'login'));
 ?>

 <div class="padding-v">
   <aside class="col2">
     <div class="box">
       <center>
         <img class="img-profil" src="../imgs/profil/photo_profil_1.png"/>
		<br/>
		<?php
        if ($_SESSION['status'] === "logged")
        {
        	echo "Status: ".$_SESSION['status']."\n";
    ?>
		<br/>
    <?php
    	   echo "Username: ".$_SESSION['logged_on_user'];
    ?>
    <br/>
       <center>
    <form method="POST" action="edit_profile.php">
        <input type="submit" name="modify" value="UPDATE">
    </form>
       </center>
    <br/>
    <form method="POST" action="index.php">
        <input type="submit" name="logout" value="LOG OUT">
    </form>
    <?php
        }
        if ($_SESSION['status'] === "notlogged")
        {
    	     echo "Status: ".$_SESSION['status']."\n";
    ?>
		<br/>
		<?php
    	   echo "Username: Unknown";
    ?>
		<br/>
    <form action="index.php" style="width:100%">
    <input type="submit" name="loginr" value="LOG IN">
    </form>
    <?php
        }
        if ($profiles[$idy]['role'] === 'adm')
        {
    ?>
		<br/>
    <form method="POST" action="edit_item.php">
        <input type="submit" name="manage" value="EDIT ITEMS">
    </form>
    <?php
    }
         ?>
       </center>
     </div>
   </aside><!--
