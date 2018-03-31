<?php

	if(isset($_SESSION['logged_on_user']))
	{
?>

<?php if(isset($_SESSION['group']) && $_SESSION['group'] == 'admin')
{
?>
		<li class="bouton_droite">
			<a href="./html/admin_article.php"><?php echo "Bonjour ".$_SESSION['logged_on_user']; ?></a>
		</li>
<?php
} else {
?>
	<li class="bouton_droite">
		<a href=""><?php echo "Bonjour ".$_SESSION['logged_on_user']; ?></a>
	</li>

<?php
}
?>
		<li class="bouton_droite">
			<a href="./php/logout.php">Déconnexion</a>
		</li>
<?php
	}
	else
	{
?>
		<li class="bouton_droite">
			<a href="./html/login.html">Connexion</a>
		</li>
<?php
	}
?>
