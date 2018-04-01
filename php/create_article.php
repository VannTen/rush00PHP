<?php
session_start();

$_SESSION['article_ajout'] = "";
$_SESSION['article_modif'] = "";
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['categorie']) && !empty($_POST['prix']) && !empty($_POST['submit']))
{
	if (!preg_match_all("/^[0-9]+[.]{0,1}[0-9]+$/", $_POST['prix']))
	{
		$categorie = $_POST['categorie'];

		$_SESSION['article_ajout'] = array('name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>array($categorie), 'prix'=>$_POST['prix'], 'image'=>$_POST['image'], 'status'=>'visible');
		echo "ERROR\n";
		header("location:../html/create_article.php?erreur=prix_erreur");
	}
	elseif (!file_exists("../bdd/article"))
	{
		$id = 1;
		if (!empty($_POST['image']))
			$img = $_POST['image'];
		else
			$img = 'none';
		$data = array(array('id'=>$id, 'name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>$_POST['categorie'], 'prix'=>$_POST['prix'], 'image'=>$img, 'status'=>'visible'));
		$serial = serialize($data);
		file_put_contents("../bdd/article", $serial);
		header("location:../html/create_article.php");
	}
	else
	{
		if (!empty($_POST['image']))
			$img = $_POST['image'];
		else
			$img = 'none';
		$exist = false;
		$fd = fopen("../bdd/article", "c+");
		flock($fd, LOCK_EX);
		$data = file_get_contents("../bdd/article");
		$file = unserialize($data);
		$id = 1;
		$id_max = 1;
		foreach ($file as $elt)
		{
			if ($elt['name'] === $_POST['name'])
				$exist = true;
			if ($elt['id'] > $id_max)
				$id_max = $elt['id'];
			if ($elt['id'] === $id)
			{
				$id = $id_max + 1;
				$id_max++;
			}
		}
		if ($exist == false)
		{
			$file[] = array('id'=>$id, 'name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>$_POST['categorie'], 'prix'=>$_POST['prix'], 'image'=>$img, 'status'=>'visible');
			$serial = serialize($file);
			file_put_contents("../bdd/article", $serial);
			flock($fd, LOCK_UN);
			header("location:../html/create_article.php");
		}
		else{
			flock($fd, LOCK_UN);
			$categorie = $_POST['categorie'];
			$_SESSION['article_ajout'] = array('name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>array($categorie), 'prix'=>$_POST['prix'], 'image'=>$_POST['image']);
			header("location:../html/create_article.php?erreur=name_existe");
		}
	}
}
else{
	$categorie = $_POST['categorie'];
	$_SESSION['article_ajout'] = array('name'=>$_POST['name'], 'description'=>$_POST['description'], 'categorie'=>array($categorie), 'prix'=>$_POST['prix'], 'image'=>$_POST['image']);

	header("location:../html/create_article.php?erreur=data_problem");
}
}else {
	header("location:../index.php");
}
?>
