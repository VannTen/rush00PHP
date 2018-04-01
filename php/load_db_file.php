
<?php
function load_db_file($path)
{
	return (load_db_file_intern($path, 'rw'));
}
function load_db_file_intern($path, $mode)
{
	$file = fopen($path, $mode);
	flock($file, LOCK_EX);
	$data = unserialize(fread($file, filesize($path)));
	$db = array('data' => $data, 'file', $file, 'mode' => $mode);
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
	if ($db['mode'] == 'rw')
	$data = serialize($db['data']);
	fwrite($db['file'], $data);
	flock($db['file'], LOCK_UN);
	fclose($db['file']);
}
?>
