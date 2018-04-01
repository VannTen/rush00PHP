<?php

	if(!empty($_SESSION['logged_on_user']))
	{
?>
<?php if(isset($_SESSION['group']) && $_SESSION['group'] == 'admin')
{
?>
		<li class="bouton_droite">
			<a href="./html/admin_panel.php"><?php echo "Bonjour ".$_SESSION['logged_on_user']; ?></a>
		</li>
<?php
} else {
?>
	<li class="bouton_droite">
		<a href="./html/profile.php"><?php echo "Bonjour ".$_SESSION['logged_on_user']; ?></a>
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
			<a href="./html/login.php">Connexion</a>
		</li>
<?php
	}
?>
