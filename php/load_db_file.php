
<?php
function load_db_file($path)
{
	return (load_db_file_intern($path, 'r'));
}
function load_db_file_intern($path, $mode)
{
	$file = fopen($path, $mode);
	flock($file, LOCK_EX);
	$data = unserialize(fread($file, filesize($path)));
	flock($file, LOCK_UN);
	fclose($file);
	$db = array('data' => $data, 'path' => $path);
	return ($db);
}
function read_db_file($path)
{
	$file = fopen($path, 'r');
	flock($file, LOCK_EX);
	$data = unserialize(fread($file, filesize($path)));
	flock($file, LOCK_UN);
	fclose($file);
	return ($data);
}
function commit_db_file($db)
{
	$file = fopen($db['path'], 'w+');
	ftruncate($file, 0);
	flock($file, LOCK_EX);
	$data = serialize($db['data']);
	fwrite($file, $data);
	flock($file, LOCK_UN);
	fclose($file);
}
?>
