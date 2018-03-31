<?php
session_start();

$_SESSION['categorie_ajout'] = "";
$_SESSION['categorie_modif'] = "";
if (!empty($_POST['name']) && !empty($_POST['submit']))
{
	if (!file_exists("../bdd/categorie"))
	{
		$data = array(array('value'=>strtolower($_POST['name']), 'name'=>$_POST['name']));
		$serial = serialize($data);
		file_put_contents("../bdd/categorie", $serial);
		echo "OK\n";
		header("location:../html/create_categorie.php");
	}
	else
	{
		$exist = false;
		$fd = fopen("../bdd/categorie", "c+");
		flock($fd, LOCK_EX | LOCK_SH);
		$data = file_get_contents("../bdd/categorie");
		$file = unserialize($data);
		foreach ($file as $elt)
		{
			if ($elt['name'] === $_POST['name'])
			{
				$exist = true;
				break;
			}
		}
		if ($exist == false)
		{
			$file[] = array('value'=>strtolower($_POST['name']), 'name'=>$_POST['name']);
			$serial = serialize($file);
			file_put_contents("../bdd/categorie", $serial);
			flock($fd, LOCK_UN);
			echo "OK\n";
			header("location:../html/create_categorie.php");
		}
		else{
			flock($fd, LOCK_UN);
			$_SESSION['categorie_ajout'] = array('value'=>strtolower($_POST['name']), 'name'=>$_POST['name']);
			echo "ERROR\n";
			header("location:../html/create_categorie.php?erreur=name_existe");
		}
	}
}
else{
	echo "ERROR\n";
	header("location:../html/create_categorie.php?erreur=data_problem");
}
?>
