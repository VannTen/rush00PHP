<?php
include __DIR__ . '/php/auth.php';
$admin = array('login' => 'admin',
	'passwd' => password_hash('admin', PASSWORD_DEFAULT),
	'group' => 'admin');
$user = array('login' => 'user',
	'passwd' => password_hash('user', PASSWORD_DEFAULT),
	'group' => 'active');
unlink('bdd/passwd');
$accounts = array($admin, $user);
$db = array('data' => $accounts, 'path' => 'bdd/passwd');
commit_db_file($db);
echo "Admin account has been created with default password\n";
?>
