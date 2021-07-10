<?php
$NIM = $_GET['nim'];
$pass = $_GET['pass'];
$step = $_GET['step'];

switch ($step) {
	case 'profil':
		if (isset($NIM) && isset($pass)){
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://mhsmobile.amikom.ac.id/login',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => 'username='.$NIM.'&keyword='.$pass,
			  CURLOPT_HTTPHEADER => array(
			    'User-Agent: @m!k0mXv=#neMob!le',
			    'Content-Type: application/x-www-form-urlencoded',
			    'Content-Length: 33',
			    'Host: mhsmobile.amikom.ac.id',
			    'Connection: Keep-Alive',
			    'Accept-Encoding: gzip',
			    'Cookie: amikom=d33d3e837675b585b8c941befd7a4a0b7f05b16b'
			  ),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			$token = get_betwen($response, '"access_token": "', '"');

			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => 'http://mhsmobile.amikom.ac.id/api/personal/init_data_mhs',
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => '',
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'POST',
			  CURLOPT_POSTFIELDS => 'http%3A%2F%2Fmhsmobile.amikom.ac.id%2Fapi%2Fpersonal%2Finit_data_mhs=',
			  CURLOPT_HTTPHEADER => array(
			    'User-Agent: @m!k0mXv=#neMob!le',
			    'Authorization: '.$token,
			    'Content-Length: 0',
			    'Host: mhsmobile.amikom.ac.id',
			    'Connection: Keep-Alive',
			    'Accept-Encoding: gzip',
			    'Content-Type: application/x-www-form-urlencoded',
			    'Cookie: amikom=ef3b1aa40d72741f7a97bc8abafef54c7de49282'
			  ),
			));

			$response = curl_exec($curl);
			curl_close($curl);
			header('Content-type: application/json; charset=UTF-8');
			echo $response;
		}

		break;
	case 'list':
		
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://mhsmobile.amikom.ac.id/login',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'username='.$NIM.'&keyword='.$pass,
		  CURLOPT_HTTPHEADER => array(
		    'User-Agent: @m!k0mXv=#neMob!le',
		    'Content-Type: application/x-www-form-urlencoded',
		    'Content-Length: 33',
		    'Host: mhsmobile.amikom.ac.id',
		    'Connection: Keep-Alive',
		    'Accept-Encoding: gzip',
		    'Cookie: amikom=d33d3e837675b585b8c941befd7a4a0b7f05b16b'
		  ),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		$token = get_betwen($response, '"access_token": "', '"');

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://mhsmobile.amikom.ac.id/api/presensi/list_mk',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS => 'npm='.$NIM.'&semester=2&tahun_akademik=2020%2F2021',
		  CURLOPT_HTTPHEADER => array(
		    'User-Agent: @m!k0mXv=#neMob!le',
		    'Authorization: '.$token,
		    'Content-Type: application/x-www-form-urlencoded',
		    'Content-Length: 52',
		    'Host: mhsmobile.amikom.ac.id',
		    'Connection: Keep-Alive',
		    'Accept-Encoding: gzip',
		    'Cookie: amikom=34f7b36aba3a91da79929d734535cd04f2bd4b02'
		  ),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		header('Content-type: application/json; charset=UTF-8');
		echo $response;
		break;
	default:
	    header('Content-type: application/json; charset=UTF-8');
		$data = array(
			'status' => false,
			'message' => "Parameter tidak lengkap!"

		);

		$jsn = json_encode($data);
		echo $jsn;
		break;
}



function get_betwen($string, $start, $end) {
		$string = " ".$string;
		$ini = strpos($string,$start);
		if ($ini == 0) return "";
		$ini += strlen($start);
		$len = strpos($string,$end,$ini) - $ini;
		return substr($string,$ini,$len);
	}














// $link = $_GET["link"];
// $link2 =$_GET["links"];

// if (isset($link) && strlen($link) >= 10 ) {
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
// 			$curl = curl_init();
// 				curl_setopt_array($curl, array(
// 				  CURLOPT_URL => 'http://penuyul.online/tik.php?link='.$link,
// 				  CURLOPT_RETURNTRANSFER => true,
// 				  CURLOPT_ENCODING => '',
// 				  CURLOPT_MAXREDIRS => 10,
// 				  CURLOPT_TIMEOUT => 0,
// 				  CURLOPT_FOLLOWLOCATION => true,
// 				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// 				  CURLOPT_CUSTOMREQUEST => 'GET',
// 				  CURLOPT_HTTPHEADER => array(
// 				    'Cookie: csrftoken=d458a9c7673560c4b1525c616297626e'
// 				  ),
// 				));
// 			$response = curl_exec($curl);
// 			curl_close($curl);

// 			$text = get_betwen($response, 'rel="nofollow">', '</a>');

// 			echo json_encode(
// 				array(
// 					'code' => 1,
// 					'data' => $text
// 				)
// 			);

// // } elseif (strlen($link) != 10) {
// // 	echo "gagal1";
// }
// else{
// 	echo json_encode(
// 		array(
// 			'code' => 0,
// 			'message' => "Link invalid."
// 		)

// 	);
// }


// // send a curl get request to get the html input
// function get_betwen($string, $start, $end) {
// 		$string = " ".$string;
// 		$ini = strpos($string,$start);
// 		if ($ini == 0) return "";
// 		$ini += strlen($start);
// 		$len = strpos($string,$end,$ini) - $ini;
// 		return substr($string,$ini,$len);
// 	}



?>