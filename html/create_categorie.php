<?php
	session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
	{
	if (!empty($_SESSION['categorie_ajout']))
		$name = $_SESSION['categorie_ajout']['name'];
	else
		$name = "";
		$panier_count = 0;
		if (!empty($_SESSION["panier"]))
			$panier_count = sizeof($_SESSION["panier"]);
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
				<meta charset="utf-8" />
				<title>Gestion d'article</title>
			</head>
			<body>
				<header>
					<ul id="menu_horizontal">
						<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
						<li class="bouton_gauche"><a href="../html/boutique.php">Boutique</a></li>
						<li class="bouton_gauche"><a href="panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php if ($panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
						<li class="bouton_gauche active"><a href="../html/admin_panel.php">Panel administrateur</a></li>
						<?php include '../php/onglet_connect.php'; ?>
					</ul>
				</header>
				<h1> Création d'une catégorie</h1>
	<?php
	if (!empty($_GET['erreur']))
		if ($_GET['erreur'] == "name_existe")
			echo "<p>Ce nom est invalide car il existe déjà dans votre base de donnée</p>";
		elseif ($_GET['erreur'] == "data_problem")
			echo "<p>Cette categorie est invalide car il manque des informations</p>";
	?>
<form action="../php/create_categorie.php" method="post">
	<span class="text">Nom: </span><input type="text" name="name" value="<?php echo $name; ?>" required />
	<br />
	<input type="submit" name="submit" value="OK" />
	<br />
</form>
</body></html>
<?php
}else {
	header("location:../index.php");
}
?>
