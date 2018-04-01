<?php
include (__DIR__ . "/load_db_file.php");
function auth($login, $passwd)
{
	//$passwd_file = $_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB'];
	$accounts = load_db_file("../bdd/passwd");
	$auth_account = NULL;
	foreach($accounts['data'] as $key => $account)
	{
		if ($account['login'] == $login)
		{
			if (password_verify($passwd, $account['passwd'])) {
				// rehash password if algo has changed.
				if (password_needs_rehash($account['passwd'], PASSWORD_DEFAULT))
				{
					$accounts['data'][$key]['passwd'] = password_hash($passwd, PASSWORD_DEFAULT);
				}
				$auth_account = $account;
			}
			break ;
		}
	}
	commit_db_file($accounts);
	return ($auth_account);
}
function get_account($login)
{
	$accounts = read_db_file("../bdd/passwd");
	foreach($accounts as $account)
	{
		if ($account['login'] == $login)
		return ($account);
	}
	return (NULL);
}
function commit_account($new_account)
{
	$result = FALSE;
	if (file_exists("../bdd/passwd"))
	{
		$accounts = load_db_file("../bdd/passwd");
		foreach($accounts['data'] as $key => $account)
		{
			if ($account['login'] == $new_account['login'])
			{
				$accounts['data'][$key] = $new_account;
				$result = TRUE;
				break ;
			}
		}
		if (!($result))
			$accounts['data'][] = $new_account;
	}
	else
	{
		$accounts = array(
			'path' => "../bdd/passwd",
			'data' => array($new_account));
	}
	commit_db_file($accounts);
	return ($result);
}
function reinit_account()
{
	unlink("../bdd/passwd");
}
?>
