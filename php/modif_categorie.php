<?php
session_start();

if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
if (!empty($_POST['newname']) && !empty($_POST['name']) && !empty($_POST['submit']))
{
	$exist = false;
	$data = file_get_contents("../bdd/article");
	$file = unserialize($data);
	foreach ($file as $elt)
	{
		if ($elt['name'] === $_POST['newname'])
		{
			$exist = true;
			break;
		}
	}
	if ($exist == false)
	{
		$modify = false;
		$fd = fopen("../bdd/categorie", "c+");
		flock($fd, LOCK_EX | LOCK_SH);
		$data = file_get_contents("../bdd/categorie");
		$file = unserialize($data);
		$i = 0;
		foreach ($file as $elem)
		{
			if ($elem['name'] === $_POST['name'])
			{
				$file[$i]['name'] = $_POST['newname'];
				$file[$i]['value'] = strtolower($_POST['newname']);
				$modify = true;
			}
			$i++;
		}
		if ($modify == true)
		{
			$serial = serialize($file);
			file_put_contents("../bdd/categorie", $serial);
			flock($fd, LOCK_UN);
			header("location:../html/admin_article.php");
		}
		else
		{
			flock($fd, LOCK_UN);
			header("location:../html/modif_categorie.php?erreur=name_noexiste");
		}
	}
	else
	{
		header("location:../html/modif_categorie.php?erreur=newname_existe");
	}
}
else
{
	header("location:../html/modif_categorie.php?erreur=data_problem");
}
}
else {
	header("location:../index.php");
}
?>
