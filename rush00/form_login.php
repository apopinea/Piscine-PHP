<?php
if (isset($_SESSION["loggued_on_user"]) && $_SESSION["loggued_on_user"] != "")
{
	?>
	<div class="loggued">
		<div>Bonjour : <?php echo $_SESSION["loggued_on_user"] ?></div>
		<form class="form_logout" action="logout.php" method="POST">
			<input type="submit" name="deco" value="deco">
		</form>
		<a href="my_cmpt.php" >Mon compte</a>
		<?php
		if (isset($_SESSION["lvl"]) && $_SESSION["lvl"] == "admin")
		{
			?>
			<a href="admin.php">admin</a>
			<?php
		}
	?>
	</div>
	<?php
}
else
{
	?>
	<form class="form_login" action="login.php" method="POST">
		<table>
			<tr>
				<td>
					<label for="login">Identifiant</label>
				</td>
				<td>
					<input type="text" name="login" id="login">
				</td>
				<?php
				if (isset($_SESSION["loggued_error"]) && $_SESSION["loggued_error"] == "error")
				{
					?>
					<td rowspan="3">login ou mot <br/> de passe erroné</td>
					<?php
					unset($_SESSION["loggued_error"]);
				}
				?>
			</tr>
			<tr>
				<td>
					<label for="passwd">Mot de passe</label>
				</td>
				<td>
					<input type="password" name="passwd" id="passwd">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" name="conect" value="Connection">
				</td>
				<td>
					<input type="submit" name="creer compte" value="Creer compte">
				</td>
			</tr>
		</table>
	</form>
	<?php
}
?>