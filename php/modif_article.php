<?php
session_start();

if (!empty($_POST['newname']) && !empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['categorie']) && !empty($_POST['prix']) && !empty($_POST['submit']))
{
	if (!preg_match_all("/^[0-9]+$/", $_POST['prix']))
	{
		echo "ERROR\n";
		header("location:../html/modif_article.php?erreur=prix_erreur");
	}
	else
	{
		$exist = false;
		$data = file_get_contents("../bdd/article");
		$file = unserialize($data);
		foreach ($file as $elt)
		{
			if ($elt['name'] === $_POST['newname'] && $_POST['newname'] != $_POST['name'])
			{
				$exist = true;
				break;
			}
		}
		if ($exist == false)
		{
			$modify = false;
			$fd = fopen("../bdd/article", "c+");
			flock($fd, LOCK_EX | LOCK_SH);
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			$i = 0;
			foreach ($file as $elem)
			{
				if ($elem['name'] === $_POST['name'])
				{
					$file[$i]['name'] = $_POST['newname'];
					$file[$i]['description'] = $_POST['description'];
					$file[$i]['categorie'] = $_POST['categorie'];
					$file[$i]['prix'] = $_POST['prix'];
					$modify = true;
				}
				$i++;
			}
			if ($modify == true)
			{
				$serial = serialize($file);
				file_put_contents("../bdd/article", $serial);
				flock($fd, LOCK_UN);
				echo "OK\n";
				header("location:../html/admin_article.php");
			}
			else
			{
				flock($fd, LOCK_UN);
				echo "ERROR\n";
				header("location:../html/modif_article.php?erreur=name_noexiste");
			}
		}
		else
		{
			flock($fd, LOCK_UN);
			echo "ERROR\n";
			header("location:../html/modif_article.php?erreur=newname_existe");
		}
	}
}
else
{
	echo "ERROR\n";
	header("location:../html/modif_article.php?erreur=data_problem");
}
?>
