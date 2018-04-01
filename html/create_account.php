<!DOCTYPE html>
<?php
$panier_count = 0;
if (!empty($_SESSION["panier"]))
	$panier_count = sizeof($_SESSION["panier"]);
?>
<html>
	<head>
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
		<title>Création de compte</title>

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
		<main>
		<div id="account_create_form">
			<h1>Création de compte</h1>
			<form  class="user_info_boxes" action="../php/create_account.php" method="POST">
				<p>Identifiant : <input name="login" type="text" /></p>
				<p>Mot de passe : <input name="passwd" type="password" /></p>
				<input name="submit" type="submit" value="Ok" />
			</form>
		</div>
		</main>
		<footer></footer>
	</body>
</html>
