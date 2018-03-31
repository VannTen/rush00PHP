<?php

	if(isset($_SESSION['pseudo']) && isset($_SESSION['password']))
	{
?>
		<li class="bouton_droite">
			<a href="https://www.dev.ajugnon.com/html/gestion_compte.php"><?php echo "Bonjour ".$_SESSION['pseudo']; ?></a>
		</li>
<?php if(isset($_SESSION['group']) && $_SESSION['group'] == 'admin')
{
?>
		<li class="bouton_droite">
			<a href="../html/admin_article.php"><?php echo "Bonjour ".$_SESSION['pseudo']; ?></a>
		</li>
<?php
}
?>
		<li class="bouton_droite">
			<a href="https://www.dev.ajugnon.com/php/deconnexion.php">Déconnexion</a>
		</li>
<?php
	}
	else
	{
?>
		<li class="bouton_droite">
			<a href="https://www.dev.ajugnon.com/html/connexion.php">Connexion</a>
		</li>
<?php
	}
?>
