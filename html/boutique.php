<?php
session_start();
if (!empty($_GET['ajouter']))
{
	if (!isset($_SESSION["panier"]))
		$_SESSION["panier"] = array();
	if (!isset($_SESSION["panier"][$_GET["ajouter"]]))
		$_SESSION["panier"][$_GET["ajouter"]] = 0;
	$_SESSION["panier"][$_GET["ajouter"]] = ($_SESSION["panier"][$_GET["ajouter"]]) + 1;
	header("location:../html/boutique.php");
}

	$panier_count = 0;
	if (!empty($_SESSION["panier"]))
		$panier_count = sizeof($_SESSION["panier"]);
?>
<html>
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link href="../css/menu.css" rel="stylesheet" media="all" type="text/css">
    	<title>Site E-commerce</title>

    </head>
	<body>
		<header>
			<ul id="menu_horizontal">
				<li class="bouton_gauche"><a href="../index.php">Accueil</a></li>
				<li class="bouton_gauche active"><a href="../html/boutique.php">Boutique</a></li>
				<li class="bouton_gauche"><a href="panier.php">Panier <span style="font-size:15px; margin-top : -2000px;"><?php if ($panier_count > 0) {print $panier_count; if ($panier_count == 1) echo " produit"; else echo " produits";}?></span></a></li>
				<?php include '../php/onglet_connect.php'; ?>
			</ul>
		</header>
<?php
if (file_exists("../bdd/article"))
{
	$data = file_get_contents("../bdd/categorie");
	$file = unserialize($data);
	$data2 = file_get_contents("../bdd/article");
	$file2 = unserialize($data2);
	foreach ($file as $elt)
	{
		$exist = "";
		foreach ($file2 as $elt2)
		{
			if (in_array($elt['value'], $elt2['categorie']))
			{
				$elt2['name'] = htmlspecialchars($elt2['name'], ENT_QUOTES);
				$elt2['description'] = htmlspecialchars($elt2['description'], ENT_QUOTES);
				$exist .= '<div style="display: inline-block;border-radius: 5px; padding-right: auto; width : 20%; text-align:center;
				min-width:200px; padding-left: auto; border : 1px solid black; margin-right: 10px; line-height : 1.6;
				margin-bottom: 10px; background-color:FloralWhite;">';

				$exist .= '<span style="color:black">Nom : '.$elt2['name'].' <br></span>';
				$exist .= '<span style="color:black">Description : '.$elt2['description'].' <br></span>';
				$exist .=  '<span style="color:black">Prix : '.$elt2['prix'].' €<br></span>';
				$exist .=  "<button onClick='location.href=\"boutique.php?ajouter=".$elt2['name']."\"'>Ajouter produit</button><br>";
				$exist .=  '</div>';
			}
		}
		if ($exist != "")
		{
			echo "<br><br><div style='width: 100%; color:black; background-color: lightgrey; border-radius: 10px; text-align:center; height: 35px; vertical-align: middle; line-height: 35px; font-size:22px'>".$elt['name']."</div><br>";
			echo $exist;
		}
	}
}

?>
<footer id="footer">
	<hr>
	<p id="copyright">© ajugnon 2018</p>
</footer>
</body>
</html>
