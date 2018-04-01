<?php
	session_start();
	$_SESSION['article_ajout'] = "";
	$_SESSION['article_modif'] = "";
	$_SESSION['categorie_modif'] = "";
	$_SESSION['categorie_ajout'] = "";
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
	{
		$panier_count = 0;
		if (!empty($_SESSION["panier"]))
			$panier_count = sizeof($_SESSION["panier"]);
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
		<h1>Gestion des articles et des catégories</h1>
	<div class="overf">
		<h2>Liste des articles</h2>
<?php
	if (file_exists("../bdd/article"))
	{
		$data = file_get_contents("../bdd/article");
		$file = unserialize($data);
		$exist = false;
		foreach ($file as $elt)
				$exist = true;
		if ($exist == true)
		{
			echo '<div class="table">';
				echo '<div class="thead">';
					echo '<div class="tr">';
						echo '<div class="td">Name</div>';
						echo '<div class="td">Image</div>';
						echo '<div class="td">Description</div>';
						echo '<div class="td">Categorie</div>';
						echo '<div class="td">Prix</div>';
						echo '<div class="td">Status</div>';
						echo '<div class="td">Action</div>';
					echo '</div>';
				echo '</div>';
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			echo '<div class="tbody">';
			foreach ($file as $elem)
			{
				$elem['name'] = htmlspecialchars($elem['name'], ENT_QUOTES);
				$elem['description'] = htmlspecialchars($elem['description'], ENT_QUOTES);

				echo '<form class="tr" action="../php/mod_supr_art.php" method="post">';
				echo '<div class="td"><span class="text">'.$elem['name'].'<input type="hidden" name="name" value="'.$elem['name'].'" /></span></div>';
				if ($elem['image'] != 'none')
					echo '<div class="td"><span><img src="'.$elem['image'].'" style="width: 150px; max-height: 100px;display: block;margin-left: auto;margin-right: auto;"> <br></span></div>';
				else
					echo '<div class="td"><span>Pas d\'image pour cette article</span></div>';
				echo '<div class="td"><span class="text">'.$elem['description'].'<input type="hidden" name="description" value="'.$elem['description'].'" /></span></div>';
				echo '<div class="td"><span class="text">';
				$N = count($elem["categorie"]);
				for($i=0; $i < $N; $i++)
				{
					$elem['categorie'][$i] = htmlspecialchars($elem['categorie'][$i], ENT_QUOTES);
					echo($elem["categorie"][$i]."<br>");
				}
				echo '</span></div>';
				echo '<div class="td"><span class="text">'.$elem['prix'].' €<input type="hidden" name="prix" value="'.$elem['prix'].'" /></span></div>';
				echo '<div class="td"><span class="text">'.$elem['status'].'<input type="hidden" name="status" value="'.$elem['status'].'" /></span></div>';
				echo '<div class="td action"><input type="submit" name="submit" value="Modifier"><input type="submit" name="submit" value="Supprimer"></div>';
				echo '</form>';
			}
				echo '</div>';
			echo '</div>';
		}
	}
?>
</div>
		<button onClick="location.href='create_article.php'">Ajouter un article</button>

<br>
<br>
<br>

<h2>Liste des catégories</h2>
<?php
if (!empty($_GET['categorie']))
	if ($_GET['categorie'] == "use_by_art")
		echo "<p>Vous ne pouvez pas modifier cette catégorie car des articles sont référencés dedans</p>";
?>
	<div class="overf">
<?php
	if (file_exists("../bdd/categorie"))
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
		<button onClick="location.href='create_categorie.php'">Ajouter une catégorie</button><br><br>
		<button onClick="location.href='user_list.php'">Accès a la liste des utilisateurs</button>
		<button onClick="location.href='boutique.php'">Accès a la boutique</button>

	</body>
</html>
<?php
}else {
	header("location:../index.php");
}
?>
