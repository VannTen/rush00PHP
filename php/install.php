<?php
include __DIR__ . '/auth.php';
$account = array('login' => 'admin',
	'passwd' => password_hash('admin', PASSWORD_DEFAULT),
	'group' => 'admin');
commit_account($account);
echo "Admin account has been created with default password\n";
?>
