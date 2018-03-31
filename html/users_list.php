<!DOCTYPE html>
<html>
	<head>
		<title>Users list</title>
		<link rel="stylesheet" type="text/css" href="global.css" />
	</head>
	<body>
		<div class="table" name="list">
			<div class="th"></div>
<?php
include (__DIR__ . '/../php/load_db_file.php');

$accounts = read_db_file('../ddb/passwd');
foreach ($accounts as $account)
{
	$non_modifiable= array('login');
	$dont_display= array('passwd');
	$options = array(
		'group' => array('admin', 'active', 'inactive'));

	echo '<form class="tr" action="update_user.php" method="POST" >' . "\n";
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
				echo 'disabled="disabled"';
			echo " />\n";
		}
	}
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
