<?php
function auth($login, $passwd)
{
	$accounts = unserialize(file_get_contents($ROOT_DIR . '/ddb/passwd'));
	foreach($accounts as $key => $account)
	{
		if ($account['login'] == $login)
		{
			if (password_verify($passwd, $account['passwd'])) {
				// rehash password if algo has changed.
				if (password_needs_rehash($account['passwd'], PASSWORD_DEFAULT))
				{
					$accounts[$key]['passwd'] = password_hash($passwd, PASSWORD_DEFAULT);
					file_put_contents($_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB'] , serialize($accounts));
				}
				return (TRUE);
			}
			else
				return (FALSE);
		}
	}
	return (FALSE);
}
?>
