<?php
include __DIR__ . '/php/auth.php';

if (!file_exists("../bdd"))
	mkdir("../bdd", 0777, true);
if (!file_exists("../bdd"))
	mkdir("../bdd", 0777, true);

// utilisateur
$admin = array('login' => 'admin',
	'passwd' => password_hash('admin', PASSWORD_DEFAULT),
	'group' => 'admin');
$user = array('login' => 'user',
	'passwd' => password_hash('user', PASSWORD_DEFAULT),
	'group' => 'active');

if (file_exists("bdd/passwd"))
	unlink('bdd/passwd');

// article
if (file_exists("bdd/article"))
	unlink('bdd/article');
$fd = fopen("bdd/article", "c+");
flock($fd, LOCK_EX);
$file = array(
	array('id'=>1, 'name'=>'Cubot X18', 'description'=>'Ecran 5.7" HD', 'categorie'=>array('téléphone','hd'), 'prix'=>'280', 'image'=>'https://images-eu.ssl-images-amazon.com/images/I/41BkklTWn9L._AC_US200_.jpg', 'status'=>'visible'),
	array('id'=>2, 'name'=>'Honor 9x', 'description'=>'Ecran 5.15" HD', 'categorie'=>array('téléphone','hd'), 'prix'=>'319.99', 'image'=>'https://images-na.ssl-images-amazon.com/images/I/41DkRypl8gL.jpg', 'status'=>'visible'),
	array('id'=>3, 'name'=>'OnePlus 5T', 'description'=>'Ecran 6" FHD', 'categorie'=>array('téléphone','fhd'), 'prix'=>'559.99', 'image'=>'https://image01.oneplus.net/ebp/201711/16/35/07f3e6e9f4be318aca15704de7fc1126.png', 'status'=>'visible'),
	array('id'=>4, 'name'=>'Huawei 20', 'description'=>'Ecran 5.8" HD', 'categorie'=>array('téléphone','fhd'), 'prix'=>'649', 'image'=>'https://images-na.ssl-images-amazon.com/images/I/41DkRypl8gL.jpg', 'status'=>'visible'),
	array('id'=>5, 'name'=>'Samsung Galaxy Tab A', 'description'=>'Ecran 10.1" HD', 'categorie'=>array('tablette'), 'prix'=>'229', 'image'=>'https://images-eu.ssl-images-amazon.com/images/I/41yf2tUciUL._AC_US160_.jpg', 'status'=>'visible'),
);
$serial = serialize($file);
file_put_contents("bdd/article", $serial);
flock($fd, LOCK_UN);

// categorie
if (file_exists("bdd/categorie"))
	unlink('bdd/categorie');
$fd = fopen("bdd/categorie", "c+");
flock($fd, LOCK_EX);
$file = array(
	array('value'=>'téléphone', 'name'=>'Téléphone'),
	array('value'=>'tablette', 'name'=>'Tablette'),
	array('value'=>'hd', 'name'=>'HD'),
	array('value'=>'fhd', 'name'=>'FHD')
);
$serial = serialize($file);
file_put_contents("bdd/categorie", $serial);
flock($fd, LOCK_UN);

// commande
if (file_exists("bdd/commande"))
	unlink('bdd/commande');
	$fd = fopen("bdd/commande", "c+");
	flock($fd, LOCK_EX);
	$file = array(
		array('id'=>1, 'client'=>"admin", 'panier'=>array(1=>1,2=>1,3=>1)),
		array('id'=>2, 'client'=>"user", 'panier'=>array(3=>4,5=>2,4=>1)),
		array('id'=>3, 'client'=>"user", 'panier'=>array(2=>4,5=>1,4=>1)),
		array('id'=>4, 'client'=>"admin", 'panier'=>array(1=>4,3=>1,2=>2))
	);
	$serial = serialize($file);
	file_put_contents("bdd/commande", $serial);
	flock($fd, LOCK_UN);

$accounts = array($admin, $user);
$db = array('data' => $accounts, 'path' => 'bdd/passwd');
commit_db_file($db);
header("location:index.php?suppr=true");
?>
