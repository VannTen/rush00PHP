<?php
session_start();

print_r($_POST);
if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['prix']) && !empty($_POST['submit']))
{
	$exist = false;
	$data = file_get_contents("../bdd/article");
	$file = unserialize($data);
	foreach ($file as $elt)
		if ($elt['name'] == $_POST['name'])
		{
			$categorie = $elt['categorie'];
			$exist = true;
		}
	if ($exist == true)
	{
		$_SESSION['article_modif'] = array('name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>array($categorie), 'prix'=>$_POST['prix']);
		if ($_POST['submit'] == "Modifier")
			header("location:../html/modif_article.php");
		elseif ($_POST['submit'] == "Supprimer")
		{
			$fd = fopen("../bdd/article", "c+");
			flock($fd, LOCK_EX | LOCK_SH);
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			$file2 = array();
			$i = 0;
			foreach ($file as $elt)
			{
				if ($elt['name'] != $_POST['name'])
					$file2[$j++] = $elt;
				$i++;
			}
			$serial = serialize($file2);
			file_put_contents("../bdd/article", $serial);
			flock($fd, LOCK_UN);
			header("location:../html/admin_article.php");
		}
	}
}
?>
