<?php
session_start();
if (isset($_SESSION['loggued_on_user']) && $_SESSION['loggued_on_user'] != "")
{
	if (isset($_POST["OK_msg"]) && $_POST["OK_msg"] == "submit" && isset($_POST["msg"]) && strip_tags($_POST["msg"]) != "")
	{
		$data = array('login' => $_SESSION['loggued_on_user'], 'time' => time(), 'msg' => strip_tags($_POST["msg"]));
		if (file_exists("../private/chat"))
		{
			$fd = fopen("../private/chat", "r+");
			flock($fd, LOCK_EX | LOCK_SH);
			$str4 = fread($fd, filesize("../private/chat"));
			rewind($fd);
			$tab = unserialize($str4);
			$tab[] = $data;
			$str3 = serialize($tab);
			fwrite($fd, $str3);
			flock($fd, LOCK_UN);
			fclose($fd);
		}
		else
		{
			if (file_exists("../private") == false)
			{
				mkdir("../private");
			}
			if (file_exists("../private/chat") == false)
			{
				$tab = array($data);
				file_put_contents("../private/chat", serialize($tab));
			}
		}
	}
	?>
		<html>
			<head>
				<script langage="javascript">top.frames['chat'].location = 'chat.php';</script>	
			</head>
			<body>
				<form method="POST" action="">  
					<input type="text" name="msg" value ="" />
					<input type="submit" name="OK_msg" value="submit">
				</form>

			</body>
		</html>
	<?php
	$_POST["submit"] = "";
}
?>