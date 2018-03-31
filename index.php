<?php
	session_start();
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
				<li class="bouton_gauche"><a href="html/boutique.php">Shop</a></li>
				<li class="bouton_gauche"><a href="html/panier.php">Panier</a></li>
				<?php include 'php/onglet_connect.php'; ?>
			</ul>
		</header>

		<footer id="footer">
			<hr>
			<p id="copyright">© ajugnon 2018</p>
		</footer>
    </body>
</html>
