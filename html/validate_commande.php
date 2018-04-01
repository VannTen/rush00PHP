<?php
session_start();
?>
<html>
	<head>
		<title>Validation commande</title>
		<link rel="stylesheet" type="text/css" href="../css/menu.css" />
	</head>

	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="../html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php if ($panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
		<div id="../php/login.php">
			<h1>Validation de commande</h1>


<?php
if (!empty($_SESSION["panier"]) && !empty($_SESSION["logged_on_user"]) && !empty($_SESSION["logged_on_user"]))
{
	if (!file_exists("../bdd/commande"))
	{
		$id = 1;
		$data = array(array('id'=>$id, 'client'=>$_SESSION["logged_on_user"], 'panier'=>$_SESSION["panier"]));
		$serial = serialize($data);
		file_put_contents("../bdd/commande", $serial);
		echo "<p>Votre commande à bien été enregistrée.</p>";
	}
	else
	{
		$exist = false;
		$fd = fopen("../bdd/commande", "c+");
		flock($fd, LOCK_EX | LOCK_SH);
		$data = file_get_contents("../bdd/commande");
		$file = unserialize($data);
		$id = 1;
		foreach ($file as $elt)
		{
			if ($elt['id'] === $id)
				$id++;
		}
		if ($exist == false)
		{
			$file[] = array('id'=>$id, 'client'=>$_SESSION["logged_on_user"], 'panier'=>$_SESSION["panier"]);
			$serial = serialize($file);
			file_put_contents("../bdd/commande", $serial);
			flock($fd, LOCK_UN);
			echo "<p>Votre commande à bien été enregistrée.</p>";
		}
		else{
			flock($fd, LOCK_UN);
			echo "<p>Une erreur a été rencontrée</p>";
		}
	}
}
else{
	echo "<p>Une erreur a été rencontrée</p>";
}
$_SESSION["panier"] = array();
?>
</div>
<footer></footer>
</body>
</html>
