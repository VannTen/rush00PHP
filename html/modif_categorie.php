<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
	if (!empty($_SESSION['categorie_modif']))
		$name = $_SESSION['categorie_modif']['name'];
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
			<h1> Modification d'une catégorie</h1>
<?php
if (!empty($_GET['erreur']))
	if ($_GET['erreur'] == "name_noexiste")
		echo "<p>Ce nom est invalide car l'élement n'existe pas dans la base de donnée</p>";
	elseif ($_GET['erreur'] == "newname_existe")
		echo "<p>Ce nom est invalide car un element possede deja le nouveau nom</p>";
	elseif ($_GET['erreur'] == "data_problem")
		echo "<p>Cette article est invalide car il manque des informations</p>";
?>
<html><body>
<form action="../php/modif_categorie.php" method="post">
	<span class="text">Nom: </span><input type="text" name="newname" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" required /><input type="hidden" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>"/>
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>
<?php
}else {
	header("location:../index.php");
}
?>
