<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
if (!empty($_SESSION['article_modif']))
{
	$name = $_SESSION['article_modif']['name'];
	$description = $_SESSION['article_modif']['description'];
	$categorie = $_SESSION['article_modif']['categorie'][0];
	$prix = $_SESSION['article_modif']['prix'];
	$image = $_SESSION['article_modif']['image'];
}
else
{
	$name = '';
	$description = '';
	$categorie = '';
	$prix = '';
	$image = '';
}
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
		<h1> Modification d'un article</h1>
<?php
if (!empty($_GET['erreur']))
	if ($_GET['erreur'] == "name_noexiste")
		echo "<p>Ce nom est invalide car l'élement n'existe pas dans la base de donnée</p>";
	elseif ($_GET['erreur'] == "newname_existe")
		echo "<p>Ce nom est invalide car un element possede deja le nouveau nom</p>";
	elseif ($_GET['erreur'] == "data_problem")
		echo "<p>Cette article est invalide car il manque des informations</p>";
	elseif ($_GET['erreur'] == "prix_erreur")
		echo "<p>Le prix que vous avez insérer est invalide</p>";
?>
<form action="../php/modif_article.php" method="post">
	<span class="text">Nom: </span><input type="text" name="newname" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>" required /><input type="hidden" name="name" value="<?php echo htmlspecialchars($name, ENT_QUOTES); ?>"/>
	<br />
	<span class="text">description: </span><input type="text" name="description" value="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>" required />
	<br />
	<?php
		$exist = false;
		$data = file_get_contents("../bdd/categorie");
		$file = unserialize($data);
		foreach ($file as $elt)
		{
			echo '<input type="checkbox" name="categorie[]" value="'.htmlspecialchars($elt['value'], ENT_QUOTES).'" ';
			if ($categorie!="" && in_array($elt['value'], $categorie))
				echo 'checked';
			echo ' ><span class="text">'.$elt['name'].'</span>';
		}
	?>
	<br />
	<span class="text">Prix: </span><input type="text" name="prix" value="<?php echo $prix; ?>" required />
	<br />
		<span class="text">Image: </span><input type="text" name="image" value="<?php echo $image; ?>" />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>
<?php
}else {
	header("location:../index.php");
}
?>
