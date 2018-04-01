<?php
	session_start();
include __DIR__ . '/auth.php';
function session_login($login, $passwd)
{
	$account = auth($login, $passwd);
	if ($account != NULL)
	{
		$_SESSION['logged_on_user'] = $account['login'];
		$_SESSION['group'] = $account['group'];
		return (true);
	}
	else
	{
		$_SESSION['logged_on_user'] = "";
		$_SESSION['group'] = "";
		return (false);
	}
}
if (array_key_exists('login', $_POST)
	&& array_key_exists('passwd', $_POST)
	&& isset($_POST['submit']) && $_POST['submit'] == 'OK'
	&& isset($_SESSION))
{
	if (session_login($_POST['login'], $_POST['passwd']))
		header("Location: ../index.php?login=success");
	else
	{
		header("Location: ../html/login.php?login=bad");
	}
}
else
{
	$_SESSION['logged_on_user'] = "";
	$_SESSION['group'] = "";
	header("Location: ../html/login.php?login=invalid");
}
?>
