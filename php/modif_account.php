<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
include __DIR__ . '/auth.php';
function modif_account($login, $new_values)
{
	$modifiable_values = array('passwd', 'group');
	$account = $get_account($login);
	if ($account != NULL)
	{
		foreach($account as $info => $value)
		{
			if (array_key_exists($info, $new_values) && in_array($info, $modifiable_values))
				$account[$info] = $new_values[$info];
		}
	}
}
// Page can be called by admin (from users_list.php) or by user (from his/her profile page)
function check_values()
{
}
function select_change_type()
{
	$can_modify = array(
		'active' => array('passwd'),
		'admin' => array('passwd', 'group'));
	if (session_status() == PHP_SESSION_ACTIVE
		&& isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] != "")
	{
		// Called from admin modifiying some account information
		if ($_SESSION['group'] == 'admin' && array_key_exists('login', $_POST))
			return (modif_account($_POST['login'], $_POST));
		else if (array_key_exists('passwd', $_POST) && auth($_SESSION['logged_on_user'], $_POST['passwd']))
		{
			if (array_key_exists('new_passwd', $_POST) && $_POST['new_passwd'] == '')
				$_POST['passwd'] = password_hash($_POST['new_passwd'], PASSWORD_DEFAULT);
			else
				unset($_POST['passwd']);
			return (modif_account($_SESSION['logged_on_user'], $_POST));
		}
	}
	else
		header('HTTP/1.0 403 Forbidden', true, 403);
}
select_change_type();
}else {
	header("location:../index.php");
}
?>
