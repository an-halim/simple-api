<?php
header('Content-type: application/json; charset=UTF-8');

function get_betwen($string, $start, $end) {
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.bmkg.go.id/gempabumi/gempabumi-dirasakan.bmkg',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Connection: keep-alive',
    'Cache-Control: max-age=0',
    'sec-ch-ua: "Google Chrome";v="87", " Not;A Brand";v="99", "Chromium";v="87"',
    'sec-ch-ua-mobile: ?0',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36',
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
    'Sec-Fetch-Site: cross-site',
    'Sec-Fetch-Mode: navigate',
    'Sec-Fetch-User: ?1',
    'Sec-Fetch-Dest: document',
    'Referer: https://www.google.com/',
    'Accept-Language: id-ID,id;q=0.9,en-US;q=0.8,en;q=0.7',
    'Cookie: ASPSESSIONIDAQAQRATQ=ICAJJFHDCBINGNBNAIMKGCOP; _ga=GA1.3.383720135.1611105685; _gid=GA1.3.3025856.1611105685; ASPSESSIONIDCCDRBQQQ=JADFAOBDIDFDNLPGOEAMOOLI; ASPSESSIONIDAACRAQQR=ECJPPNBDMBGGLEMNLHIADNOG; ASPSESSIONIDAQRBBRTT=FPECHLBDGIICBLBFDCDOKMCN; ASPSESSIONIDSSSCCSST=BKFBPNBDIENPAEFAJBEPFIDB; _gat=1'
  ),
));

$response = curl_exec($curl);
curl_close($curl);

function search($string){

  if (stripos($string, '<td>1</td>') !== false) {
    return true;
  } else {
    return false;
  }

}

if (search($response)) {
    sleep(1);
  $mentah = get_betwen($response, '<td>1</td>', '<td>2</td>');
  $gambar = get_betwen($mentah, 'src="', '"');
  $magnitude = get_betwen($mentah, 'magnitude"></span>', '</li>');
  $kedalaman = get_betwen($mentah, 'kedalaman"></span>', '</li>');
  $koordinat = get_betwen($mentah, 'koordinat"></span>', '</li>');
  $lokasi = get_betwen($mentah, 'lokasi np"></span>', '</li>');
  $waktuMentah = get_betwen($response, '<td>1</td>', $koordinat);
  $waktuMentah = str_replace('<td>', '', $waktuMentah);
  $waktuMentah = str_replace('</td>', '', $waktuMentah);
  $waktu = str_replace('<br>', ' ', $waktuMentah);
  $waktu = str_replace('\r\n\t\t\t', '', $waktu);
  $waktu = explode("\r\n\t\t\t", $waktu);

  $data = array(
      'status' => 200,
      'message' => "Sukses",
      'data' => array(
        'waktu' => $waktu[1],       
        'lokasi' => $lokasi,
        'koordinat' => $koordinat,
        'magnitude' => $magnitude,
        'kedalaman' => $kedalaman,
        'peta' => $gambar
      )
  );
  $data = json_encode($data, JSON_PRETTY_PRINT);
  echo $data;

} else {
  $data = array(
      'status' => 403,
      'message' => 'Failed',
      'data' => 'Unknown error!'

  );
  $data = json_encode($data, JSON_PRETTY_PRINT);
  echo $data;
}
