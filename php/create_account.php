<?php
function has_value($string)
{
	return ((isset($_POST[$string])) && "" != $_POST[$string]);
}

function search_account($tab_accounts, $login)
{
	foreach($tab_accounts as $value)
	{
		if ($value['login'] == $login)
			return ($value);
	}
	return NULL;
}

function create_account()
{
	$ROOT_DIR = '..';
	if (has_value('login') && has_value('password') && has_value('submit') && $_POST['submit'] == "OK")
	{
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		if (file_exists($_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB']))
		{
			$tab_accounts = unserialize(file_get_contents($ROOT_DIR . '/ddb/passwd'));
			$account = search_account($tab_accounts, $login);
		}
		else
			$account = NULL;
		if ($account != NULL)
			return (false);
		else
		{
			$account = array('login' => $login,
				'passwd' => password_hash($passwd, PASSWORD_DEFAULT),
				'group' => 'active');
			$tab_accounts[] = $account;
			file_put_contents($_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB'], serialize($tab_accounts));
			return (true);
		}
	}
}
if (create_account())
	echo "OK\n";
else
	echo "ERROR\n";
?>
