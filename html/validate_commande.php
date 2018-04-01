<?php
session_start();
$_SESSION["panier"] = array();
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
			<p>Votre commande à bien été enregistrée.
		</div>
		<footer></footer>
	</body>
</html>
