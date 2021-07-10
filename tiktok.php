<?php

$link = $_GET["link"];
// $link2 =$_GET["links"];

if (isset($link) && strlen($link) >= 10 ) {
		// $ch = curl_init();
		// curl_setopt($ch, CURLOPT_URL, $link);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// $html = curl_exec($ch);

		// // find all heading (h2) elements on the page

		// $dom = new DOMDocument();

		// @ $dom->loadHTML($html);

		// $h2s = $dom->getElementsByTagName('head'); // DOMNodeList object

		// $h2_array = array();

		// foreach($h2s as $h2) {
		//     $title_text = $h2->textContent;
		//     $h2_array[] = $title_text;
		//     echo json_encode(

		//     	array(
		//     		'code' => 1,
		//     		'massage' => $title_text

		//     	)
		//     );
		    	
		// }
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

			echo json_encode(
				array(
					'code' => 1,
					'data' => $text
				)
			);

// } elseif (strlen($link) != 10) {
// 	echo "gagal1";
}
else{
	echo json_encode(
		array(
			'code' => 0,
			'message' => "Link invalid."
		)

	);
}


// send a curl get request to get the html input
function get_betwen($string, $start, $end) {
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}



?>