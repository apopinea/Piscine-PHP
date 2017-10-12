<?php
include('auth.php');
$_db_path = "../DB/";
$_db_users = "db_users.json";
session_start();
if (!$_SESSION['status'])
	header ("Location: index.php");
$profiles = json_decode(file_get_contents($_db_path.$_db_users), TRUE);
$idx = array_search($_SESSION['logged_on_user'], array_column($profiles, 'login'));
if ($idx !== FALSE)
	$user = $profiles[$idx];
if ($_POST['delete']!= null) {
	if ($_POST['delete'] === "DELETE ACCOUNT") {
		if (isset($_POST['delpass']))
		{
			$p_pwd = hash("whirlpool", strip_tags($_POST['delpass']));
			if ($user['pwd'] === $p_pwd)
			{
				unset($profiles[$idx]);
				$profiles = array_values($profiles);
				file_put_contents($_db_path.$_db_users,json_encode($profiles));
				$_SESSION = array();
				session_destroy();
				header("Location: index.php");
				exit;
			}
			$wrong = 2;
		}
		$wrong = 2;
	}
}
if ($_POST['new']!= null) {
	if ($_POST['new'] === "UPDATE PASSWORD") {
		if (isset($_POST['oldpass']) &&
			isset($_POST['newpass']) &&
			isset($_POST['confirm']) &&
			$_POST['newpass'] === $_POST['confirm'])
		{
			$p_pwd = hash("whirlpool", strip_tags($_POST['oldpass']));
			if ($user['pwd'] === $p_pwd)
			{
				$profiles[$idx]['pwd'] = hash("whirlpool", strip_tags($_POST['newpass']));
				file_put_contents($_db_path.$_db_users,json_encode($profiles));
				$right = 1;
			}
			else
				$wrong = 2;
		}
		else
			$wrong = 2;
	}
}
if ($_POST['update']!= null) {
  if ($_POST['update'] === "UPDATE PROFILE") {
    if (isset($_POST['forname']) &&
        isset($_POST['name']) &&
        isset($_POST['login']) &&
        isset($_POST['mail']) &&
        isset($_POST['tel']) &&
        isset($_POST['addr']))
	{
          $p_forname = strip_tags($_POST['forname']);
          $p_name = strip_tags($_POST['name']);
          $p_login = strip_tags($_POST['login']);
          $p_mail = strip_tags($_POST['mail']);
          $p_tel = strip_tags($_POST['tel']);
          $p_addr = strip_tags($_POST['addr']);
          $p_image = strip_tags($_POST['image']);
          if ($p_forname !== "" && $p_name !== "" && $p_login !== "" &&
              $p_mail !== "" && $p_tel !== "" && $p_addr !== "")
		  {
				if ($p_login !== $_SESSION['logged_on_user'] &&
					array_search($p_login, array_column($profiles, 'login')))
				{
					$wrong = 1;
				}
				else
				{	
					$idx = array_search($_SESSION['logged_on_user'], array_column($profiles, 'login'));
					if ($idx !== FALSE)
					{
						$user = $profiles[$idx];
						$profile = array(
							'login'=>$p_login,
							'forname'=>$p_forname,
							'name'=>$p_name,
							'mail'=>$p_mail,
							'tel'=>$p_tel,
							'addr'=>$p_addr,
							'last_panier'=>'',
							'role'=>$user['role'],
							'pwd'=>$user['pwd'],
							'image'=>$p_image);
						unset($profiles[$idx]);
						$profiles = array_values($profiles);
						$profiles[] = $profile;
						$user = $profile;
						file_put_contents($_db_path.$_db_users,json_encode($profiles));
						$_SESSION['logged_on_user'] = $p_login;
						$right = 2;
					}
				}
		  }
	}
  }
}
?>

<?php
require_once('../parts/header.php');
require_once('../parts/left-side.php');
?>

--><article class="col8">
  <div class="box">
    <div class="container-central">
      <div class="edit_item_form_container">
        <form action="edit_profile.php" method="post" id="edit_profile">
          <label style="text-align: left">First Name : </label>
          <input type="text" name="forname" value="<?php echo $user['forname'];?>">
          <label>Last Name : </label>
          <input type="text" name="name" value="<?php echo $user['name'];?>">
          <label>Login : </label>
          <input type="text" name="login" value="<?php echo $user['login'];?>">
          <label>E-Mail : </label>
          <input type="text" name="mail" value="<?php echo $user['mail'];?>">
          <label>Tel. : </label>
          <input type="text" name="tel" value="<?php echo $user['tel'];?>">
          <label>Address : </label>
		  <textarea type="text" style="width:90%" name="addr"><?php echo $user['addr'];?></textarea>
		<br/>
		<center>
		  <input type="submit" name="update" style="background-color:DarkGoldenRod" value="UPDATE PROFILE">
		</center>
	</form>
		<br/>
	<form action="edit_profile.php" method="post" id="edit_pass">
          <label style="text-align: left">Old Password: </label>
		<br/>
          <input type="password" name="oldpass">
          <label style="text-align:left">New Password: </label>
		<br/>
          <input type="password" name="newpass">
          <label style="text-align: left">Confirm New Password: </label>
		<br/>
          <input type="password" name="confirm">
		<br/>
		<center>
		  <input type="submit" name="new" style="background-color:DarkGoldenRod" value="UPDATE PASSWORD">
	</form>
		<br/>
	<form action="edit_profile.php" method="post" id="delete_acc">
          <label style="text-align: left">Password: </label>
		<br/>
          <input type="password" name="delpass">
		<br/>
		  <input type="submit" name="delete" style="background-color:red" value="DELETE ACCOUNT">
	</form>
		</center>
	<?PHP
		if ($wrong === 1)
	{?>
		<center>
	<?PHP echo "User already exist";} ?>
		</center>
	<?PHP
		if ($wrong === 2)
	{?>
		<center>
	<?PHP echo "Incorrect password information";} ?>
		</center>
	<?PHP
		if ($right === 1)
	{?>
		<center>
	<?PHP echo "Password correctly changed";} ?>
		</center>
	<?PHP
		if ($right === 2)
	{?>
		<center>
	<?PHP echo "Profile updated";} ?>
		</center>
      </div>
    </div>
  </div>
</article><!--

<?php
require_once('../parts/right-side.php');
require_once('../parts/footer.php');
 ?>
