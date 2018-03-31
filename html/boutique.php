<?php
session_start();
if (!empty($_GET['ajouter']))
{
	if (!isset($_SESSION["panier"]))
		$_SESSION["panier"] = array();
	if (!isset($_SESSION["panier"][$_GET["ajouter"]]))
		$_SESSION["panier"][$_GET["ajouter"]] = 0;
	$_SESSION["panier"][$_GET["ajouter"]] = ($_SESSION["panier"][$_GET["ajouter"]]) + 1;
	header("location:../html/boutique.php");
}

	$panier_count = 0;
	if (!empty($_SESSION["panier"]))
		$panier_count = sizeof($_SESSION["panier"]);
?>
<a href="panier.php">Voir le panier</a> (<?php print $panier_count; if ($panier_count == 0) echo " produit"; else echo " produits";?>)
<a href="admin_article.php">Accès a la page de gestion de produit</a><br>
<br>
<br>
<br>

<?php
if (file_exists("../bdd/article"))
{
	$data = file_get_contents("../bdd/categorie");
	$file = unserialize($data);
	$data2 = file_get_contents("../bdd/article");
	$file2 = unserialize($data2);
	foreach ($file as $elt)
	{
		echo "<br>".$elt['name']."<br>";
		foreach ($file2 as $elt2)
		{
			if (in_array($elt['value'], $elt2['categorie']))
			{
				echo '<div style="display: inline-block; padding-right: auto; width : 20%; text-align:center;
				min-width:200px; padding-left: auto; border : 1px solid black; margin-right: 10px;
				margin-bottom: 10px">';
				echo '<p>Nom : '.$elt2['name'].' </p>';
				echo '<p>Description : '.$elt2['description'].' </p>';
				echo '<p>Catégorie : ';
				$N = count($elt2["categorie"]);
				for($i=0; $i < $N; $i++)
					echo($elt2["categorie"][$i]."<br>");
				echo ' </p>';
				echo '<p>Prix : '.$elt2['prix'].' €</p>';
				echo "<button onClick='location.href=\"boutique.php?ajouter=".$elt2['name']."\"'>Ajouter produit</button><br>";
				echo '</div>';
			}
		}
	}
}
?>
