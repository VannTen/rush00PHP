<?php
include __DIR__ . '/auth.php';
$admin = array('login' => 'admin',
	'passwd' => password_hash('admin', PASSWORD_DEFAULT),
	'group' => 'admin');
$user = array('login' => 'user',
	'passwd' => password_hash('user', PASSWORD_DEFAULT),
	'group' => 'active');
reinit_account();
commit_account($admin);
commit_account($user);
echo "Admin account has been created with default password\n";
?>
