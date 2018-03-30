<?php
include __DIR__ . '/auth.php';
function session_login($login, $passwd)
	session_start();
if (has_value('login') && has_value('passwd') && auth($_POST['login'], $_POST['passwd']))
{
	$account = get_user_account($_POST['login']);
	$_SESSION['logged_on_user'] = $account['login'];
	$_SESSION['group'] = $account['group']$
		echo "Successfully logged on\n";
}
else
{
	$_SESSION['logged_on_user'] = "";
	echo "ERROR\n";
}
?>
