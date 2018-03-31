<?php
session_start();
if (!empty($_SESSION['article_modif']))
{
	$name = $_SESSION['article_modif']['name'];
	$description = $_SESSION['article_modif']['description'];
	$categorie = $_SESSION['article_modif']['categorie'][0];
	$prix = $_SESSION['article_modif']['prix'];
}
else
{
	$name = '';
	$description = '';
	$categorie = '';
	$prix = '';
}
?>
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
<html><body>
<form action="../php/modif_article.php" method="post">
	Nom: <input type="text" name="newname" value="<?php echo $name; ?>" required /><input type="hidden" name="name" value="<?php echo $name; ?>"/>
	<br />
	description: <input type="text" name="description" value="<?php echo $description; ?>" required />
	<br />
	<?php
		$exist = false;
		$data = file_get_contents("../bdd/categorie");
		$file = unserialize($data);
		foreach ($file as $elt)
		{
			echo '<input type="checkbox" name="categorie[]" value="'.$elt['value'].'" ';
			if ($categorie!="" && in_array($elt['value'], $categorie))
				echo 'checked';
			echo ' >'.$elt['name'];
		}
	?>
	<br />
	Prix: <input type="text" name="prix" value="<?php echo $prix; ?>" required />
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>
