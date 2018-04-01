<?php
session_start();
if (!isset($_SESSION['logged_on_user']) || $_SESSION['logged_on_user'] == '')
	header('Location: /index.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Profile</title>
		<link rel="stylesheet" type="text/css" href="global.css" />
	</head>
	<body>
		<div class="user_profile" name="list">
<?php
include_once('../php/auth.php');
$account = get_account($_SESSION['logged_on_user']);
$non_modifiable= array('login');
$dont_display= array('passwd');
?>
<form class="tr" method="POST" action="<?php echo "../php/modif_account.php?redirect_url=" . $_SERVER['REQUEST_URI'] ?>" >
Identifiant
<input class="td" name="login" value="<?php echo htmlspecialchars($_SESSION['logged_on_user'])?>" readonly />
<br />Ancien mot de passe
<input class="td" name="current_passwd" value"" />
<br />Nouveau mot de passe
<input class="td" name="passwd" value="" />
<br />
<input class="td" name="submit" type="submit" value="OK">
<br />
	</form>
	</div>
	</body>
	</html>
