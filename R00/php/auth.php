
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
?>
