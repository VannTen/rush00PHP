<?php
session_start();
	if (!empty($_SESSION['categorie_modif']))
		$name = $_SESSION['categorie_modif']['name'];
	else
		$name = "";
?>
<?php
if (!empty($_GET['erreur']))
	if ($_GET['erreur'] == "name_noexiste")
		echo "<p>Ce nom est invalide car l'élement n'existe pas dans la base de donnée</p>";
	if ($_GET['erreur'] == "newname_existe")
		echo "<p>Ce nom est invalide car un element possede deja le nouveau nom</p>";
	elseif ($_GET['erreur'] == "data_problem")
		echo "<p>Cette article est invalide car il manque des informations</p>";
?>
<html><body>
<form action="../php/modif_categorie.php" method="post">
	Nom: <input type="text" name="newname" value="<?php echo $name; ?>" required /><input type="hidden" name="name" value="<?php echo $name; ?>"/>
	<br />
	<input type="submit" name="submit" value="OK" />
</form>
</body></html>
