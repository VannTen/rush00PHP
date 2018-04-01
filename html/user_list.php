<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
	$panier_count = 0;
	if (!empty($_SESSION["panier"]))
		$panier_count = sizeof($_SESSION["panier"]);
?>
<!DOCTYPE html>
<html>
	<head>
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
		<link href="../css/admin_article.css" rel="stylesheet" type="text/css">
		<title>Liste utilisateur</title>
	</head>
	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche"><a href="../html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php if ($panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<li class="bouton_gauche active"><a href="../html/admin_panel.php">Panel administrateur</a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
		<h1>Gestion des utilisateurs</h1>
		<h2>Liste des utilisateurs</h2>
<?php
include ('../php/load_db_file.php');
$accounts = read_db_file('../bdd/passwd');
echo '<div class="table">';
	echo '<div class="thead">';
		echo '<div class="tr">';
			echo '<div class="td">Nom</div>';
			echo '<div class="td">Mot de passe</div>';
			echo '<div class="td">Catégorie</div>';
			echo '<div class="td">Action</div>';
		echo '</div>';
	echo '</div>';
echo '<div class="tbody">';
foreach ($accounts as $account)
{
	$non_modifiable= array('login');
	$dont_display= array('passwd');
	$options = array(
		'group' => array('admin', 'active', 'inactive'));

	echo '<form class="tr" method="POST" action="../php/modif_account.php'
	.	'?redirect_url='  . explode('?',$_SERVER['REQUEST_URI'])[0] . "\">";
	foreach ($account as $info => $value)
	{
		if (array_key_exists($info, $options))
		{
			echo  '<div class="td"><select class="td" name="' . $info  . '">';
			foreach($options[$info] as $option)
			{
				echo  '<option value="' . $option . '"';
				if ($account[$info] == $option)
					echo 'selected';
				echo '>'  . $option . '</option>';
			}
			echo '</select></div>';
		}
		else
		{
			$affich;
			if (!in_array($info, $dont_display))
				$affich = "text";
			else
				$affich = "password";
			echo '<div class="td"><input class="td" type="'.$affich.'" name="' . $info . '" value="';
			if (!in_array($info, $dont_display))
				echo htmlspecialchars($value, ENT_QUOTES);
			echo '"';
			if (in_array($info, $non_modifiable))
				echo 'readonly';
			echo " /></div>";
		}
	}
	echo '<div class="td"><input class="td" name="submit" type="submit" value="OK"></div>';
	echo '</form>';
	//echo "<br />\n";
}
	if (isset($_GET['modif']))
	{
echo '<span class="confirm_text">';
		switch ($_GET['modif'])
		{
		case 'ok':
			echo "Successfully modified\n";
			break ;
		case 'fail':
			echo "No modification done\n";
			break ;
		}
echo '<span>';
	}
echo '</div>';
echo '</div>';
/*
disabled="disabled" />'
	. '<input class="td"name="password" type="text" >'
	. '<select class="td"name="group">'
	. '<option value="admin" selected>Admin</option>'
	. '<option value="active" selected>Active</option>'
	. '</select>'
	. '<input class="td" name="submit" type="submit" value="OK">'
}
}
*/
?>
	</body>
	</html>
<?php
}else {
	header("location:../index.php");
}
?>
