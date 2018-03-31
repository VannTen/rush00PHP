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
?>

<!DOCTYPE html>
<html>
	<body>
		<h3>Mon panier</h3>
		<a href="panier.php?vider=1">Vider le panier</a>
		<hr>
<?php
	$data = file_get_contents("../bdd/article");
	$file = unserialize($data);
	//afficher le contenu de la session
		if (!empty($_SESSION["panier"]))
			foreach ($_SESSION["panier"] as $key=>$value)
				foreach ($file as $elt)
					if ($elt['name'] == $key)
					{
						echo "Nom : ".$elt['name']." Quantité : ".$value." Prix : ".$elt['prix']."€";
						echo "<button onClick='location.href=\"panier.php?ajouter=".$elt['name']."\"'>Ajouter</button>";
						echo "<button onClick='location.href=\"panier.php?enlever=".$elt['name']."\"'>";
						if ($value == 0)
							echo "Supprimer";
						else
							echo "Enlever";
						echo "</button><br>";
					}
?>
<button onClick="<?php if (!empty($_SESSION['login'])) echo 'location.href=\'validate_commande.php\''; else echo 'alert(\'Vous devez etre connecté pour finaliser votre commande\')'; ?>">Valider votre commande</button><br>
		<hr>
		<a href="boutique.php">Continue shopping</a>
	</body>
</html>
