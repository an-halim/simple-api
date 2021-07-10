<?php
//error_reporting(0);
header('Content-Type: application/json; charset=UTF-8');
// array('CcE90h_IZ96Z6EaJ3JYatzQCfJJK4uq6_CONReNK', 'kG-mQLnV0LTBi~Cf05z1fpUrK~NfrqmqoEthEXr4');

$api = file_get_contents("api.json");
$api = json_decode($api, true);

$msg = $_GET['pesan'];


function execMsg($msg){
	$i = 0;
	global $api;

	do {
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://wsapi.simsimi.com/190410/talk',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS =>'{
	    "utext": "'.$msg.'",
	    "lang": "id",
	    "country" : ["ID"],
        "atext_bad_prob_max": 0.7
	}',
	  CURLOPT_HTTPHEADER => array(
	    'Content-Type: application/json',
	    'x-api-key: '.$api[$i]
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$response = json_decode($response, true);
	$resp = $response['atext'];
	$status = $response['status'];

	if ($status == 200) {
		$data = array(
			'status' => 200,
			'message' => $resp
		);

		echo json_encode($data, JSON_PRETTY_PRINT);
		break;
	} elseif (count($api) == $i){
	    goto out;
	}
	
	$i++;
	} while ($response['status'] != 200);
	out:
	if ($response['status'] != 200) {
		$data = array(
			'status' => 400,
			'message'=> 'Api key habis!'

			);
		echo json_encode($data, JSON_PRETTY_PRINT);
	}
}


if (isset($msg) && !empty($msg)) {
	execMsg($msg);
}else{
	$data = array(
		'status' => 400,
		'message' => 'Api key habis!'
	);

	echo json_encode($data, JSON_PRETTY_PRINT);
}
