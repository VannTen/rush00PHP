<?php
function load_db_file($path)
{
	$file = fopen($path, "rw");
	flock($passwd, LOCK_EX);
	$data = unserialize(fread($file, filesize($path)));
	$db = array('data' => $data, 'file', $file);
	return ($db);
}

function commit_db_file($db)
{
	$data = serialize($db['data']);
	fwrite($db['file'], $data);
	flock($db['file'], LOCK_UN);
	fclose($db['file']);
}
?>
