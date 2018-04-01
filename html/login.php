<!DOCTYPE html>
<html>
	<head>
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
		<title>Connexion</title>

	</head>

	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="../html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="panier.php">Panier
<span style="font-size:15px; margin-top : -2000px;">
<?php if (isset($panier_count) && $panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
		<div id="../php/login.php">
			<h1>Login</h1>
			<form class="user_info_boxes" action="../php/login.php" method="POST">
				<p>Identifiant : <input name="login" type="text" /></p>
				<p>Mot de passe : <input name="passwd" type="password" /></p>
				<input name="submit" type="submit" value="OK" />
<?php
if (isset($_GET['login']))
{
	echo "<span class='error_text'>";
	switch ($_GET['login']) {
	case 'bad':
		echo "Wrong username/password combinaison";
		break ;
	case 'invalid':
		echo "Invalid parameters !\n";
		break ;
	case 'disabled':
		echo "Account has been deactivated\n";
		break ;
	}
	echo '</span>';
}
?>
			</form>
		</div>
		<p>Si vous n'êtes pas encore inscrit, <a href="create_account.php">cliquez ici</a></p>
		<footer></footer>
	</body>
</html>
