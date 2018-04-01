<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
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
				flock($fd, LOCK_EX);
				$data = file_get_contents("../bdd/article");
				$file = unserialize($data);
				$i = 0;
				foreach ($file as $elt)
				{
					if ($elt['name'] == $_POST['name'])
						$file[$i]['status'] = 'disable';
					$i++;
				}
				$serial = serialize($file);
				file_put_contents("../bdd/article", $serial);
				flock($fd, LOCK_UN);
				header("location:../html/admin_article.php");
			}
		}
	}
}
else {
	header("location:../index.php");
}
?>
