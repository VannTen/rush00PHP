<?php
include __DIR__ . 'auth.php';
function modif_account($login, $new_values)
{
	$modifiable_values = array('passwd', 'group');
	$account = $get_account($login);
	if ($account != NULL)
	{
		foreach($account as $info => $value)
		{
			if (array_key_exists($info, $new_values) && in_array($info, $modifiable_values))
				$account[$info] = $new_values[$info]);
		}
	}
}
// Page can be called by admin (from users_list.php) or by user (from his/her profile page)
function allow_acces()
{
	if (session_status() == SESSION_ACTIVE
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
				unset $_POST['passwd'];
			return (modif_account($_SESSION['logged_on_user'], $_POST));
		}
	}
}
?>
