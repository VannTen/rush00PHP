<?php
	session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
	{
	if (!empty($_SESSION['categorie_ajout']))
		$name = $_SESSION['categorie_ajout']['name'];
	else
		$name = "";
?>
<html><body>
	<?php
	if (!empty($_GET['erreur']))
		if ($_GET['erreur'] == "name_existe")
			echo "<p>Ce nom est invalide car il existe déjà dans votre base de donnée</p>";
		elseif ($_GET['erreur'] == "data_problem")
			echo "<p>Cette categorie est invalide car il manque des informations</p>";
	?>
<form action="../php/create_categorie.php" method="post">
	Nom: <input type="text" name="name" value="<?php echo $name; ?>" required />
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
