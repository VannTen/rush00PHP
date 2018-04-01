<?php
session_start();
if (isset($_SESSION['group']) && $_SESSION['group'] == "admin")
{
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Liste utilisateur</title>
		<link rel="stylesheet" type="text/css" href="global.css" />
	</head>
	<body>
		<div class="table" name="list">
			<div class="th"></div>
<?php
include ('../php/load_db_file.php');
$accounts = read_db_file('../bdd/passwd');
foreach ($accounts as $account)
{
	$non_modifiable= array('login');
	$dont_display= array('passwd');
	$options = array(
		'group' => array('admin', 'active', 'inactive'));
	echo '<form class="tr" method="POST" action="../php/modif_account.php'
	.	'?redirect_url=' . $_SERVER['REQUEST_URI'] . "\">\n";
	foreach ($account as $info => $value)
	{
		if (array_key_exists($info, $options))
		{
			echo  '<select class="td" name="' . $info  . '">' . "\n";
			foreach($options[$info] as $option)
			{
				echo  '<option value="' . $option . '"';
				if ($account[$info] == $option)
					echo 'selected';
				echo '>'  . $option . '</option>' . "\n";
			}
			echo '</select>';
		}
		else
		{
			echo '<input class="td" name="' . $info . '" value="';
			if (!in_array($info, $dont_display))
				echo $value;
			echo '"';
			if (in_array($info, $non_modifiable))
				echo 'readonly';
			echo " />\n";
		}
	}
	echo "\n" . '<input class="td" name="submit" type="submit" value="OK">' . "\n";
	echo "<br />\n";
}
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
	</form>
	</div>
	</body>
	</html>
<?php
}else {
	header("location:../index.php");
}
?>
