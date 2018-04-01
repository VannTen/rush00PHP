<?php

/*
* Functions defs
*/
include __DIR__ . '/auth.php';
function modif_account($login, $new_values)
{
	$can_modify = array(
		'active' => array('passwd'),
		'admin' => array('passwd', 'group'));
	$account = get_account($login);
	echo "$login\n";
	print_r($account);
	if ($account != NULL)
	{
		$account_modif = false;
		foreach($account as $info => $value)
		{
			if (array_key_exists($info, $new_values))
			{
				if (in_array($info, $can_modify[$_SESSION['group']]))
				{
					if ($info == 'passwd')
					{
						$account[$info] =
							password_hash($new_values[$info], PASSWORD_DEFAULT);
					}
					else
						$account[$info] = $new_values[$info];
					$account_modif = true;
				}
			}
		}
		if ($account_modif)
			commit_account($account);
	}
	else
		return ($modif_account);
}
// Page can be called by admin (from users_list.php) or by user (from his/her profile page)
function select_change_type()
{
	if (session_status() == PHP_SESSION_ACTIVE
		&& isset($_SESSION['logged_on_user']) && $_SESSION['logged_on_user'] != "")
	{
		// Called from admin modifiying some account information
		if ($_SESSION['group'] == 'admin' && array_key_exists('login', $_POST))
			return (modif_account($_POST['login'], $_POST));
		else if (array_key_exists('current_passwd', $_POST) && auth($_SESSION['logged_on_user'], $_POST['current_passwd']))
		{
			// Called from user account management page
			echo "call from_user";
			return (modif_account($_SESSION['logged_on_user'], $_POST));
		}
	}
	else
		header('HTTP/1.0 403 Forbidden', true, 403);
}

/*
* Pages actions
*/

if (isset($_GET['redirect_url']) && $_GET['redirect_url'] == '')
	header('location:..' . $_GET['redirect_url'], true, 303);
session_start();
select_change_type();
?>
