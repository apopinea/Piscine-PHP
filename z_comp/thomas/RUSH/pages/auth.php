<?PHP
function secure($str)
{
	$str = htmlspecialchars($str);
	return($str);
}

function auth($login, $pwd)
{
	$login = secure($login);
	$pwd = hash("whirlpool", secure($pwd));
	$data = file_get_contents('../DB/db_users.json');
	$json = json_decode($data, true);
	$key = array_search($login, array_column($json, 'login'));
	$user = $json[$key];
	if ($key !== FALSE && $user['pwd'] === $pwd)
	{
		return (1);
	}
	else
		return (0);
}

function create($nlogin, $npwd, $name, $last, $mail, $addr, $tel)
{
	$nlogin = secure($nlogin);
	$npwd = hash("whirlpool", secure($npwd));
	$users = file_get_contents('../DB/db_users.json');
	$json = json_decode($users, true);
	$newarray = array(
					'login'=>$nlogin,
					'forname'=>$name,
					'name'=>$last,
					'mail'=>$mail,
					'tel'=>$tel,
					'addr'=>$addr,
					'last_panier'=>'',
					'role'=>'client',
					'pwd'=>$npwd,
					'image'=>'');
	if (array_search($mail, array_column($json, 'mail')) || array_search($nlogin, array_column($json, 'login')))
		return (-1);
	array_push($json, $newarray);
	$data = json_encode($json);
	file_put_contents('../DB/db_users.json', json_encode($json));
	return (1);
}
?>
