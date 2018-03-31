<?php
	session_start();
	$_SESSION['article_ajout'] = "";
	$_SESSION['article_modif'] = "";
	$_SESSION['categorie_modif'] = "";
	$_SESSION['categorie_ajout'] = "";
//	if (isset($_SESSION['login']) && isset($_SESSION['groupe']) && $_SESSION['login'] != "" && $_SESSION['group'] != "Admin")
//	{

?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/admin_article.css" rel="stylesheet" type="text/css">
		<meta charset="utf-8" />
		<title>Gestion d'article</title>
	</head>
	<body>
	<div class="overf">
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
						echo '<div class="td">Description</div>';
						echo '<div class="td">Categorie</div>';
						echo '<div class="td">Prix</div>';
						echo '<div class="td">Action</div>';
					echo '</div>';
				echo '</div>';
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			echo '<div class="tbody">';
			foreach ($file as $elem)
			{
				echo '<form class="tr" action="../php/mod_supr_art.php" method="post">';
				echo '<div class="td">'.$elem['name'].'<input type="hidden" name="name" value="'.$elem['name'].'" /></div>';
				echo '<div class="td">'.$elem['description'].'<input type="hidden" name="description" value="'.$elem['description'].'" /></div>';
				echo '<div class="td">';
				$N = count($elem["categorie"]);
				for($i=0; $i < $N; $i++)
					echo($elem["categorie"][$i]."<br>");
				echo '</div>';
				echo '<div class="td">'.$elem['prix'].'<input type="hidden" name="prix" value="'.$elem['prix'].'" /></div>';
				echo '<div class="td action"><input type="submit" name="submit" value="Modifier"><input type="submit" name="submit" value="Supprimer"></div>';
				echo '</form>';
			}
				echo '</div>';
			echo '</div>';
		}
	}
?>
</div>
		<button onClick="location.href='create_article.php'">Ajout</button>

<br>
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
					echo '</div>';
				echo '</div>';
			$data = file_get_contents("../bdd/categorie");
			$file = unserialize($data);
			echo '<div class="tbody">';
			foreach ($file as $elem)
			{
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
		<button onClick="location.href='create_categorie.php'">Ajout</button><br>
		<button onClick="location.href='boutique.php'">Accès a la boutique</button>

	</body>
</html>
<?php
//}else {
//	header("location:http://www.example.com/");
//}
?>
