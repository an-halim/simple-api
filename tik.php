<?php

$arrayLink = array(
	'1' => "https://www.tiktok.com/@ngekkkkuy/video/6904641594356485378",
	'2' => "https://www.tiktok.com/@ngekkkkuy/video/6898609615999651074",
	'3' => "https://www.tiktok.com/@ngekkkkuy/video/6896801480687357186"

 );

$link = $arrayLink[rand(1, 3)];

$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'http://penuyul.online/tik.php?link='.$link,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'GET',
	  CURLOPT_HTTPHEADER => array(
	    'Cookie: csrftoken=d458a9c7673560c4b1525c616297626e'
	  ),
	));
$response = curl_exec($curl);
curl_close($curl);


$text = get_betwen($response, 'rel="nofollow">', '</a>');
$arr = array();
$arr['info'] = 'success';
$arr['data'] = $text;

echo json_encode($arr);

function get_betwen($string, $start, $end) {
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}
?>