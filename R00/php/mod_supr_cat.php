<?php
session_start();

print_r($_POST);
if (!empty($_POST['name']) && !empty($_POST['submit']))
{
	$exist = false;
	$data = file_get_contents("../bdd/categorie");
	$file = unserialize($data);
	foreach ($file as $elt)
		if ($elt['name'] == $_POST['name'])
			$exist = true;
	if ($exist == true)
	{
		if ($_POST['submit'] == "Modifier")
		{
			$use = false;
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			foreach ($file as $elt)
			{
				if (in_array(strtolower($_POST['name']), $elt['categorie']))
				{
					$use = true;
					break;
				}
			}
			if ($use == false)
			{
				$_SESSION['categorie_modif'] = array('name'=>$_POST['name']);
				header("location:../html/modif_categorie.php");
			}
			else
				header("location:../html/admin_article.php?categorie=use_by_art");
		}
		elseif ($_POST['submit'] == "Supprimer")
		{
			$use = false;
			$data = file_get_contents("../bdd/article");
			$file = unserialize($data);
			foreach ($file as $elt)
			{
				if (in_array(strtolower($_POST['name']), $elt['categorie']))
				{
					$use = true;
					break;
				}
			}

			if ($use == false)
			{
				$fd = fopen("../bdd/categorie", "c+");
				flock($fd, LOCK_EX | LOCK_SH);
				$data = file_get_contents("../bdd/categorie");
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
				file_put_contents("../bdd/categorie", $serial);
				flock($fd, LOCK_UN);
				header("location:../html/admin_article.php");
			}
			else
			{
				header("location:../html/admin_article.php?categorie=use_by_art");
			}
		}
	}
}
?>
