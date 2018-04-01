<?php
	session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
	{
	if (!empty($_SESSION['article_ajout']))
	{
		$name = $_SESSION['article_ajout']['name'];
		$description = $_SESSION['article_ajout']['description'];
		$categorie = $_SESSION['article_ajout']['categorie'][0];
		$prix = $_SESSION['article_ajout']['prix'];
		$image = $_SESSION['article_ajout']['image'];
	}
	else
	{
		$name = "";
		$description = "";
		$categorie = "";
		$prix = "";
		$image = "";
	}
?>
<html><body>
	<?php
	if (!empty($_GET['erreur']))
		if ($_GET['erreur'] == "name_existe")
			echo "<p>Ce nom est invalide car il existe déjà dans votre base de donnée</p>";
		elseif ($_GET['erreur'] == "data_problem")
			echo "<p>Cette article est invalide car il manque des informations</p>";
		elseif ($_GET['erreur'] == "prix_erreur")
			echo "<p>Le prix que vous avez insérer est invalide</p>";
	?>
<form action="../php/create_article.php" method="post">
	Nom: <input type="text" name="name" value="<?php echo $name; ?>" required />
	<br />
	description: <input type="text" name="description" value="<?php echo $description; ?>" required />
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
			echo ' >'.$elt['name'];
		}
	?>
	</select>
	<br />
	Prix: <input type="text" name="prix" value="<?php echo $prix; ?>" required />
	<br />
	Image: <input type="text" name="image" value="<?php echo $image; ?>" />
	<br />
	<input type="submit" name="submit" value="OK" />
	<br />
	<button onClick="location.href='admin_article.php'">Retour vers la page d'administration</button>
</form>
</body></html>
<?php
}else {
	header("location:../index.php");
}
?>
