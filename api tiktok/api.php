<?php

$store_locally = true; /* change to false if you don't want to host videos locally */ 

function downloadVideo($video_url, $geturl = false)
{
    $ch = curl_init();
    $headers = array(
        'Range: bytes=0-',
    );
    $options = array(
        CURLOPT_URL            => $video_url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_FOLLOWLOCATION => true,
        CURLINFO_HEADER_OUT    => true,
        CURLOPT_USERAGENT => 'okhttp',
        CURLOPT_ENCODING       => "utf-8",
        CURLOPT_AUTOREFERER    => true,
        CURLOPT_COOKIEJAR      => 'cookie.txt',
	CURLOPT_COOKIEFILE     => 'cookie.txt',
        CURLOPT_REFERER        => 'https://www.tiktok.com/',
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_MAXREDIRS      => 10,
    );
    curl_setopt_array( $ch, $options );
    if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    }
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($geturl === true)
    {
        return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    }
    curl_close($ch);
    $dir = "user_videos/";
    $file = scandir($dir);
    $files = count($file) - 2 + 1;
    $filess = "video".$files;
    $filename = "user_videos/" . $filess . ".mp4";
    $d = fopen($filename, "w");
    fwrite($d, $data);
    fclose($d);
    return $filename;
}

if (isset($_GET['url']) && !empty($_GET['url'])) {
    if ($_SERVER['HTTP_REFERER'] != "") {
        $url = $_GET['url'];
        $name = downloadVideo($url);
        echo $name;
        exit();
    }
    else
    {
        echo "";
        exit();
    }
}

function getContent($url, $geturl = false)
  {
    $ch = curl_init();
    $options = array(
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.111 Mobile Safari/537.36',
        CURLOPT_ENCODING       => "utf-8",
        CURLOPT_AUTOREFERER    => false,
        CURLOPT_COOKIEJAR      => 'cookie.txt',
	CURLOPT_COOKIEFILE     => 'cookie.txt',
        CURLOPT_REFERER        => 'https://www.tiktok.com/',
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_MAXREDIRS      => 10,
    );
    curl_setopt_array( $ch, $options );
    if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    }
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($geturl === true)
    {
        return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    }
    curl_close($ch);
    return strval($data);
  }

  function getKey($playable)
  {
  	$ch = curl_init();
  	$headers = [
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Accept-Encoding: gzip, deflate, br',
    'Accept-Language: en-US,en;q=0.9',
    'Range: bytes=0-200000'
	];

    $options = array(
        CURLOPT_URL            => $playable,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HEADER         => false,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        CURLOPT_ENCODING       => "utf-8",
        CURLOPT_AUTOREFERER    => false,
        CURLOPT_COOKIEJAR      => 'cookie.txt',
	CURLOPT_COOKIEFILE     => 'cookie.txt',
        CURLOPT_REFERER        => 'https://www.tiktok.com/',
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_MAXREDIRS      => 10,
    );
    curl_setopt_array( $ch, $options );
    if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
      curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
    }
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    $tmp = explode("vid:", $data);
    if(count($tmp) > 1){
    	$key = trim(explode("%", $tmp[1])[0]);
    }
    else
    {
    	$key = "";
    }
    return $key;
  }

if (isset($_GET['tiktok-url']) && !empty($_GET['tiktok-url'])) {
			$url = trim($_GET['tiktok-url']);
			$resp = getContent($url);
			//echo "$resp";
			$check = explode('"downloadAddr":"', $resp);
			if (count($check) > 1){
				$contentURL = explode("\"",$check[1])[0];
                $contentURL = str_replace("\\u0026", "&", $contentURL);
				$thumb = explode("\"",explode('og:image" content="', $resp)[1])[0];
				$username = explode('/',explode('"$pageUrl":"/@', $resp)[1])[0];
				$create_time = explode(',', explode('"createTime":', $resp)[1])[0];
				$dt = new DateTime("@$create_time");
				$create_time = $dt->format("d M Y H:i:s A");
				$videoKey = getKey($contentURL);
				$cleanVideo = "https://api2-16-h2.musical.ly/aweme/v1/play/?video_id=$videoKey&vr_type=0&is_play_url=1&source=PackSourceEnum_PUBLISH&media_type=4";
				$cleanVideo = getContent($cleanVideo, true);
				if (!file_exists("user_videos") && $store_locally){
					mkdir("user_videos");
				}
				if ($store_locally){
                 	$url = $contentURL;
			        $name = downloadVideo($url);
			        // echo $name;
			        header('Content-type: application/json; charset=UTF-8');
			        $dir = "user_videos/";
                    $file = scandir($dir);
                    $files = count($file) - 2;
                    $arr = array (
                        'status' => true,
                        'data' => $files,
                        'username' => $username,
                        'upload' => $create_time,
                        'link' => 'http://api.budakcinta.my.id/tiktok/'.$name
                        );
                    echo json_encode($arr, JSON_PRETTY_PRINT);
			        exit();
				
				}
		
					

			}

}else {
    $dir = "user_videos/";
    $file = scandir($dir);
    $files = count($file) - 2;
    
    $arr = array(
        'status' => false,
        'data' => $files
        );
    header('content-type: application/json; charset=UTF-8');
    echo json_encode($arr, JSON_PRETTY_PRINT);
}

?>