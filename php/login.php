<?php
session_start();
include __DIR__ . '/auth.php';
function session_login($login, $passwd)
{
	$account = auth($login, $passwd);
	if ($account != NULL)
	{
		if ($account['group'] == 'inactive')
			return ('inactive');
		$_SESSION['logged_on_user'] = $account['login'];
		$_SESSION['group'] = $account['group'];
		return ('OK');
	}
	else
	{
		$_SESSION['logged_on_user'] = "";
		$_SESSION['group'] = "";
		return ('bad_auth');
	}
}
if (array_key_exists('login', $_POST)
	&& array_key_exists('passwd', $_POST)
	&& isset($_POST['submit']) && $_POST['submit'] == 'OK'
	&& isset($_SESSION))
{
	switch (session_login($_POST['login'], $_POST['passwd']))
	{
	case 'OK':
		header("Location: ../index.php?login=success");
		break ;
	case 'bad_auth':
		header("Location: ../html/login.php?login=bad");
		break ;
	case 'inactive':
		header("Location: ../html/login.php?login=disabled");
		break ;
	}
}
else
{
	$_SESSION['logged_on_user'] = "";
	$_SESSION['group'] = "";
	header("Location: ../html/login.php?login=invalid");
}
?>
