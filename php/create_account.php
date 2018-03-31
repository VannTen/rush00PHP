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
	//$passwd_file = $_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB'];
	$passwd_file = $_SERVER['DOCUMENT_ROOT'] . "/ddb/passwd";
	if (has_value('login') && has_value('passwd') && has_value('submit') && $_POST['submit'] == "OK")
	{
		$login = $_POST['login'];
		$passwd = $_POST['passwd'];
		if (file_exists($passwd_file))
		{
			$tab_accounts = unserialize(file_get_contents($passwd_file));
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
			file_put_contents($passwd_file, serialize($tab_accounts));
			return (true);
		}
	}
}
if (create_account())
	echo "OK\n";
else
	echo "ERROR\n";
?>
