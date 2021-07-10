<?php
error_reporting(0);
header('Content-type: application/json; charset=UTF-8');
$text = $_GET['text'];

if (isset($text) && !empty($text)) {
	$text = str_replace('a', 'i', $text);
	$text = str_replace('u', 'i', $text);
	$text = str_replace('e', 'i', $text);
	$text = str_replace('o', 'i', $text);
	$text = str_replace('A', 'I', $text);
	$text = str_replace('U', 'I', $text);
	$text = str_replace('E', 'I', $text);
	$text = str_replace('O', 'I', $text);

	$data = array(
		'status' => 200,
		'message' => 'Sukses',
		'data' => $text
	);
	echo json_encode($data, JSON_PRETTY_PRINT);
} elseif (empty($text)) {
	header('HTTP/1.1 403');
	$data = array(
		'status' => 403,
		'message' => 'Failed',
		'data' => '[!] Parameter tidak lengkap'
	);
	echo json_encode($data, JSON_PRETTY_PRINT);
}

?>