<?php
session_start();
if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == '')
	header('Location: /index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
		<title>Profile</title>
	</head>
	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="../html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="panier.php">Panier
<span style="font-size:15px; margin-top : -2000px;">
<?php if (isset($panier_count) && $panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
		<div class="user_profile" name="list">
<?php
include_once('../php/auth.php');
$account = get_account($_SESSION['logged_on_user']);
$non_modifiable= array('login');
$dont_display= array('passwd');
?>
<form class="tr" method="POST" action="<?php echo "../php/modif_account.php?redirect_url=" .
explode('?' ,$_SERVER['REQUEST_URI'])[0] ?>" >
<span class="text">Identifiant :</span>
<input class="td" name="login" value="<?php echo htmlspecialchars($_SESSION['logged_on_user'])?>" disabled />
<br /><span class="text">Ancien mot de passe :</span>
<input class="td" name="current_passwd" value"" />
<br /><span class="text">Nouveau mot de passe :</span>
<input class="td" name="passwd" value="" />
<br />
<input class="td" name="submit" type="submit" value="OK">
<br />
	</form>
<?php
	if (isset($_GET['modif']))
	{
		switch ($_GET['modif'])
		{
		case 'ok':
			echo '<span class="confirm_text">Successfully modified</span>' . "\n";
			break ;
		case 'fail':
			echo '<span class="confirm_text">Bad password</span>' . "\n";
			break ;
		}
	}
?>
	</div>
	</body>
	</html>
