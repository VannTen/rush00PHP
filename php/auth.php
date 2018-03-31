<?php
function auth($login, $passwd)
{
	//$passwd_file = $_ENV['DATA_DIR'] . "/" . $_ENV['PASSWD_DB'];
	$passwd_file_path = "../ddb/passwd";
	$passwd_file = fopen($passwd_file_path, "rw");
	flock($passwd_file, LOCK_EX);
	$accounts = unserialize(fread($passwd_file, filesize($passwd_file_path)));
	$auth_account = NULL;
	foreach($accounts as $key => $account)
	{
		if ($account['login'] == $login)
		{
			if (password_verify($passwd, $account['passwd'])) {
				// rehash password if algo has changed.
				if (password_needs_rehash($account['passwd'], PASSWORD_DEFAULT))
				{
					$accounts[$key]['passwd'] = password_hash($passwd, PASSWORD_DEFAULT);
					$passwd_file = serialize($accounts);
					fwrite($passwd_file);
					fflush($passwd_file);
				}
				$auth_account = $account;
			}
			break ;
		}
	}
	flock($passwd_file, LOCK_UN);
	fclose($passwd_file);
	return ($auth_account);
}
?>
