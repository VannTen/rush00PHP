<?php
	session_start();
	$_SESSION['article_ajout'] = "";
	$_SESSION['article_modif'] = "";
	$_SESSION['categorie_modif'] = "";
	$_SESSION['categorie_ajout'] = "";
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
	{

?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
		<link href="../css/admin_article.css" rel="stylesheet" type="text/css">
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
		<h1>Panel administrateur</h1>
	<div class="overf">
<h2>Liste des commandes réalisées sur le site</h2>
<?php
if (!empty($_GET['categorie']))
	if ($_GET['categorie'] == "use_by_art")
		echo "<p>Vous ne pouvez pas modifier cette catégorie car des articles sont référencés dedans</p>";
?>
	<div class="overf">
<?php
	if (file_exists("../bdd/commande"))
	{
		$data = file_get_contents("../bdd/categorie");
		$file = unserialize($data);
		$exist = false;
		foreach ($file as $elt)
				$exist = true;
		if ($exist == true)
		{
			echo '<div class="table2">';
				echo '<div class="thead">';
					echo '<div class="tr">';
						echo '<div class="td">Name</div>';
						echo '<div class="td">Action</div>';
					echo '</div>';
				echo '</div>';
			$data = file_get_contents("../bdd/categorie");
			$file = unserialize($data);
			echo '<div class="tbody">';
			foreach ($file as $elem)
			{
				$elem['name'] = htmlspecialchars($elem['name'], ENT_QUOTES);
				echo '<form class="tr" action="../php/mod_supr_cat.php" method="post">';
				echo '<div class="td"><input type="text" name="name" value="'.$elem['name'].'" disabled="disabled" /><input type="hidden" name="name" value="'.$elem['name'].'" /></div>';
				echo '<div class="td action"><input type="submit" name="submit" value="Modifier"><input type="submit" name="submit" value="Supprimer"></div>';
				echo '</form>';
			}
				echo '</div>';
			echo '</div>';
		}
	}
?>
</div>
		<button onClick="location.href='user_list.php'">Accès a la liste des utilisateurs</button>
		<button onClick="location.href='boutique.php'">Accès a la boutique</button>

	</body>
</html>
<?php
}else {
	header("location:../index.php");
}
?>
