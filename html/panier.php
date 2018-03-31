<?php
// Start the session
session_start();
// eventuellement vider le panier
if (isset($_GET["vider"]))
	$_SESSION["panier"] = array();
if (isset($_GET["ajouter"]) && isset($_SESSION["panier"][$_GET["ajouter"]]))
{
	$_SESSION["panier"][$_GET["ajouter"]]++;
	header("location:../html/panier.php");
}
if (isset($_GET["enlever"]) && isset($_SESSION["panier"][$_GET["enlever"]]) && $_SESSION["panier"][$_GET["enlever"]] > 0)
{
	$_SESSION["panier"][$_GET["enlever"]]--;
	header("location:../html/panier.php");
}
elseif (isset($_GET["enlever"]) && isset($_SESSION["panier"][$_GET["enlever"]]) && $_SESSION["panier"][$_GET["enlever"]] <= 0)
{
	unset ($_SESSION["panier"][$_GET["enlever"]]);
	header("location:../html/panier.php");
}

$panier_count = 0;
if (!empty($_SESSION["panier"]))
	$panier_count = sizeof($_SESSION["panier"]);
?>

<!DOCTYPE html>
<html>
<head>
	<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
	<title>Gestion du pannier</title>
</head>
	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="../html/boutique.php">Shop</a></li>
				<li class="bouton_gauche active"><a href="../html/panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php print $panier_count; if ($panier_count == 0) echo " produit"; else echo " produits";?></span></a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
		<h1>Mon panier</h1>

<?php
	$data = file_get_contents("../bdd/article");
	$file = unserialize($data);
	//afficher le contenu de la session
		if (!empty($_SESSION["panier"]))
			foreach ($_SESSION["panier"] as $key=>$value)
				foreach ($file as $elt)
					if ($elt['name'] == $key)
					{
						echo "<span style='color : white'> Nom : ".$elt['name']." Quantité : ".$value." Prix : ".$value * $elt['prix']."€</span>";
						echo "<button onClick='location.href=\"panier.php?ajouter=".$elt['name']."\"'>Ajouter</button>";
						echo "<button onClick='location.href=\"panier.php?enlever=".$elt['name']."\"'>";
						if ($value == 0)
							echo "Supprimer";
						else
							echo "Enlever";
						echo "</button><br>";
					}
?>
<div style="width:100%">
		<button onClick='location.href="panier.php?vider=1"'>Vider le panier</button>
		<button onClick="<?php if (!empty($_SESSION['login'])) echo 'location.href=\'validate_commande.php\''; else echo 'alert(\'Vous devez etre connecté pour finaliser votre commande\')'; ?>">Valider votre commande</button>
		<button onClick='location.href="boutique.php"'>Continuez vos achats</button>
</div>
	</body>
</html>
