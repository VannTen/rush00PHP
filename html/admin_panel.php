<?php
	session_start();
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
		<title>Panel Administration</title>
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
		$data = file_get_contents("../bdd/commande");
		$file = unserialize($data);
		$exist = false;
		foreach ($file as $elt)
			$exist = true;
		if ($exist == true)
		{
			echo '<div class="table2">';
				echo '<div class="thead">';
					echo '<div class="tr">';
						echo '<div class="td">Num de commande</div>';
						echo '<div class="td">Utilisateur</div>';
						echo '<div class="td">Liste des articles</div>';
						echo '<div class="td">Total</div>';
					echo '</div>';
				echo '</div>';
			$data = file_get_contents("../bdd/commande");
			$file = unserialize($data);
			$data3 = file_get_contents("../bdd/passwd");
			$file3 = unserialize($data3);
			echo '<div class="tbody">';
			foreach ($file3 as $elem3)
				foreach ($file as $elem)
				{
					if ($elem['client'] == $elem3['login'])
					{
						$elem['client'] = htmlspecialchars($elem['client'], ENT_QUOTES);
						echo '<form class="tr" action="" method="post">';
						echo '<div class="td"><input type="text" name="name" value="'.$elem['id'].'" disabled="disabled" /><input type="hidden" name="name" value="'.$elem['id'].'" /></div>';
						echo '<div class="td"><input type="text" name="name" value="'.$elem['client'].'" disabled="disabled" /><input type="hidden" name="name" value="'.$elem['client'].'" /></div>';
						echo '<div class="td"><span class="text">';
						foreach($elem["panier"] as $key=>$elem4)
						{
							$element = '';
							$quantity = 0;
							$data2 = file_get_contents("../bdd/article");
							$file2 = unserialize($data2);
							foreach ($file2 as $elem2)
							{
								if ($key == $elem2['id'])
								{
									$element = $elem2['name'];
									$quantity = $elem4;
								}
							}
							$element = htmlspecialchars($element, ENT_QUOTES);
							echo $quantity.' '.$element."<br>";
						}
						if (empty($elem["total"]))
							$elem["total"] = 0;
						echo '</span></div>';
						echo '<div class="td"><input type="text" name="valeur" value="'.$elem["total"].' €" disabled="disabled" /><input type="hidden" name="valeur" value="'.$elem["total"].'" /></div>';
						echo '</form>';
					}
				}
			echo '</div>';
		echo '</div>';
		}
	}
?>
</div>
		<button onClick="location.href='user_list.php'">Accès a la liste des utilisateurs</button>
		<button onClick="location.href='admin_article.php'">Accès a la liste des produits</button>
		<button onClick="location.href='boutique.php'">Accès a la boutique</button>

	</body>
</html>
<?php
}else {
	header("location:../index.php");
}
?>
