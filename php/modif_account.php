<?php
function modif_account($login, $new_values)
{
	$account = $get_account($login);
	if ($account != NULL)
	{
		foreach($account as $info => $value)
		{
			if (array_key_exists($info, $new_values)
				$account[$info] = $new_values[$info]);
		}
	}
	return (false);
}
if (modif_account())
	echo "OK\n";
else
	echo "ERROR\n";
?>
