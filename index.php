<?php
	session_start();

	$panier_count = 0;
	if (!empty($_SESSION["panier"]))
		$panier_count = sizeof($_SESSION["panier"]);
?>

<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="css/menu.css" rel="stylesheet" media="all" type="text/css">
    	<title>Site E-commerce</title>

    </head>
    <body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche active"><a href="index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="html/panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php if ($panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<?php include 'php/onglet_connect2.php'; ?>
			</ul>
		</header>

<div>

<div>
	</body>
</html>
